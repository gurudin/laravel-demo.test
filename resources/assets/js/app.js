import Vue from 'vue';
import VueResource from 'vue-resource';
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n';
import store from './rms/store/';
import routes from './rms/routes';
import messages from './rms/message.json';

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
  user: $.getCookie('user-info') ? JSON.parse($.getCookie('user-info')) : null,
};

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

// 实例化路由
const router = new VueRouter({
  routes
});

router.beforeEach((to, from, next) => {
  /* must call `next` */
  if (!Vue.prototype.GLOBAL.user) {
    window.location.href = '/sign#/in';
  }
  
  // Set title
  document.title = to.meta.title
    ? to.meta.title
    : Vue.prototype.GLOBAL.title;

  // Add group
  let groupId = to.query.group
    ? to.query.group
    : from.query.group;
  Vue.prototype.GLOBAL.user.groupId = groupId;
  // if (!groupId) {
  //   window.location.href = '/sign#/select';
  // }

  if (to.query.group) {
    next();
  } else {
    next({ path: to.path, query: { group: groupId } });
  }
});

Vue.component('menu-tree', require('./rms/components/menu.vue'));
Vue.component('menu-child', require('./rms/components/menuChild.vue'));
if (document.getElementById("app") != null) {
  // 实例化 Vue
  var vm = new Vue({
    data() {
      return {
        name: this.GLOBAL.user.name,
        groupId: this.GLOBAL.user.groupId,
      };
    },
    store,
    router,
    i18n,
    methods: {
      logout() {
        $.clearCookie('user-info');
        window.location.reload();
      }
    },
  }).$mount('#app');
}
