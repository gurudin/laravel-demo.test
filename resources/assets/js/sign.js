import Vue from 'vue';
import VueResource from 'vue-resource';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n';
import messages from './rms/message.json';
import api from './rms/api';

Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(VueI18n);

require('./bootstrap');

require('./rms/custom');

/**
 * 全局设置
 */
Vue.prototype.GLOBAL = {
  title: 'RMS',
  api: api,
  user: $.getCookie('user-info') ? JSON.parse($.getCookie('user-info')) : null,
};

// Set resource
Vue.prototype.GLOBAL.api.setResource(Vue.prototype.GLOBAL.user);

// 实例化路由
const router = new VueRouter({
  routes: [
    { path: '/in', component: require('./rms/page/sign/signin.vue') },
    { path: '/up', component: require('./rms/page/sign/signup.vue') },
    { path: '/select', component: require('./rms/page/sign/select.vue') },
  ]
});

router.beforeEach((to, from, next) => {
  /* must call `next` */
  if (!Vue.prototype.GLOBAL.user && to.path != '/in') {
    next('/in');
  }

  // Set title
  document.title = to.meta.title
    ? to.meta.title
    : Vue.prototype.GLOBAL.title;

  next();
});

// 本地化
const langArray = ['en', 'zh-cn'];
if (langArray.indexOf(document.documentElement.lang) > 0) {
  var lang = document.documentElement.lang;
} else {
  var lang = 'en';
}
const i18n = new VueI18n({
  locale: lang,
  messages
});

if (document.getElementById("app") != null) {
  // 实例化 Vue
  var vm = new Vue({
    router,
    i18n
  }).$mount('#app');
}