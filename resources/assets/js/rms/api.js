import Vue from 'vue';
import VueResource from 'vue-resource';
Vue.use(VueResource);

const API_ROOT = '';

export default ({
  setResource(user) {
    Vue.http.interceptors.push((request, next) => {
      request.headers.set('Accept', 'application/json');
      if (user) {
        request.headers.set('Authorization', 'Bearer ' + user.token);
        request.headers.set('Group-id', user.groupId);
      }

      next(response =>{
        if (response.status == 401) {
          window.lcation.href = '/admin';
        }
        if (response.status == 403) {
          alert(response.body);
          console.log(response.body);
        }

      });
    });
  },

  /** Auth */
  // Get group by auth
  getAuthGroup() {
    return Vue.resource(API_ROOT + '/api/authGroup').get();
  },
  // Get menu by auth
  getAuthMenu(groupId = 0) {
    if (groupId == 0) {
      return Vue.resource(API_ROOT + '/api/authMenu').get();
    } else {
      return Vue.resource(API_ROOT + '/api/authMenu/' + groupId).get();
    }
  },
  // Get user by groupId
  getAuthUser(groupId = 0) {
    return Vue.resource(API_ROOT + '/api/authUser/' + groupId).get();
  },
  // Get user detail by (userId, groupId)
  getAuthUserDetail(userId, groupId) {
    return Vue.resource(API_ROOT + '/api/authUserDetail/' + userId + '/' + groupId).get();
  },
  // Get group permission by groupIds(1,2,3)
  getAuthGroupPermission(groupIds) {
    return Vue.resource(API_ROOT + '/api/authGroupPermission/' + groupIds).get();
  },
  // Set auth assignment
  setAuthAssignment(data) {
    return Vue.resource(API_ROOT + '/api/authAssignment').save(data);
  },
  // Remove auth assignment
  removeAuthAssignment(data) {
    return Vue.resource(API_ROOT + '/api/authAssignment').remove(data);
  },
  /** Auth end */

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
  },
  /* Auth group api end */

  /** Sign api */
  // Login
  login(data) {
    return Vue.resource(API_ROOT + '/api/login').save(data);
  },
  // Register
  register(data) {
    return  Vue.resource(API_ROOT + '/api/register').save(data);
  }
  /** Sign api end */
});
