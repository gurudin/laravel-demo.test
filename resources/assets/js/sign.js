import Vue from 'vue';
import VueResource from 'vue-resource';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n';
import messages from './rms/message.json';

Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(VueI18n);

require('./bootstrap');

require('./rms/custom');

// 实例化路由
const router = new VueRouter({
  routes: [
    { path: '/in', component: require('./rms/page/sign/signin.vue') },
    { path: '/up', component: require('./rms/page/sign/signup.vue') },
  ]
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