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
  }
});
