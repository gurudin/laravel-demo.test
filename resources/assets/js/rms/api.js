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
  /** Auth item */
  // Get role item
  getRole() {
    return Vue.resource(API_ROOT + '/api/getRole').get();
  },
  // Get permission item.
  getPermission() {
    return Vue.resource(API_ROOT + '/api/getPermission').get();
  },
  // Set auth item (route or permission or role)
  setAuthItem(data) {
    return Vue.resource(API_ROOT + '/api/authItem').save(data);
  },
  // Update auth item (route or permission or role)
  updateAuthItem(data) {
    return Vue.resource(API_ROOT + '/api/authItem').update(data);
  },
  // Remove auth item (route or permission or role)
  removeAuthItem(data) {
    return Vue.resource(API_ROOT + '/api/authItem').remove(data);
  },
  /** Auth item end */

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

  /* Auth group api */
  getGroup() {
    return Vue.resource(API_ROOT + '/api/group').get();
  },
  // Set auth group 
  setAuthGroup(data) {
    return Vue.resource(API_ROOT + '/api/group').save(data);
  },
  // Update auth group 
  updateAuthGroup(data) {
    return Vue.resource(API_ROOT + '/api/group').update(data);
  },
  // Remove gorup by id
  removeAuthGroup(id) {
    return Vue.resource(API_ROOT + '/api/group').remove({id: id});
  },
  // Get user item.
  getUser() {
    return Vue.resource(API_ROOT + '/api/user').get();
  },
  // Get group user child item
  getUserChildItem(id) {
    return Vue.resource(API_ROOT + '/api/groupUserChild/' + id).get();
  },
  // Get group item child item
  getItemChildItem(id) {
    return Vue.resource(API_ROOT + '/api/groupItemChild/' + id).get();
  },
  // Set group child
  setGroupChild(data) {
    return Vue.resource(API_ROOT + '/api/groupChild').save(data);
  },
  // Remove group child
  removeGroupChild(data) {
    return Vue.resource(API_ROOT + '/api/groupChild').remove(data);
  }
  /* Auth group api end */
});
