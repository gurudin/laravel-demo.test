import Vue from 'vue';
import VueResource from 'vue-resource';
Vue.use(VueResource);

// 设置 Laravel 的 csrfToken
// Vue.http.interceptors.push((request, next) => {
//   request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);
//   next();
// });

const API_ROOT = '';

export default ({
  // Get permission list.
  getPermission() {
    return Vue.resource(API_ROOT + '/api/getPermission').get();
  },
  // Set auth item (route or permission or role)
  setAuthItem(data) {
    return Vue.resource(API_ROOT + '/api/authItem').save(data);
  },
  // Remove auth item (route or permission or role)
  removeAuthItem(data) {
    return Vue.resource(API_ROOT + '/api/authItem').remove(data);
  },

  /** Auth item child */
  getPermissionRoute(name) {
    return Vue.resource(API_ROOT + '/api/authItemChild/' + name).get();
  },
  setPermissionRoute(data) {
    return Vue.resource(API_ROOT + '/api/authItemChild').save(data);
  },
  deletePermissionRoute(data) {
    return Vue.resource(API_ROOT + '/api/authItemChild').remove(data);
  },
  /** Auth item child end */

  /* Menu api */
  // Get menu list.
  getMenuList() {
    return Vue.resource(API_ROOT + '/api/menu').get();
  },
  // Get menu detail By id.
  getMenuDetail(id) {
    return Vue.resource(API_ROOT + '/api/menu/' + id).get();
  },
  // Set menu
  setMenu(data) {
    return Vue.resource(API_ROOT + '/api/menu').save(data);
  },
  // Dlete Menu
  deleteMenu(id) {
    return Vue.resource(API_ROOT + '/api/menu').remove({ id: id });
  },
  /* Menu api end */
});
