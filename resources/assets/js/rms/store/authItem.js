import api from '../api';

export default {
  state: {
    /** Route item */
    permissionItem: [],
    /** Permission Route Item */
    permissionRouteItem: [],
    /** Role item */
    roleItem: [],
  },
  mutations: {
    getPermission(state, result) {
      state.permissionItem = result;
    },
    getPermissionRoute(state, result) {
      state.permissionRouteItem = result;
    },
    getRole(state, result) {
      state.roleItem = result;
    }
  },
  actions: {
    getPermission({ commit }) {
      api.getPermission().then(function (res) {
        commit('getPermission', res.data.data);
      });
    },
    getPermissionRoute({ commit }, name) {
      api.getPermissionRoute(name).then(function (res) {
        commit('getPermissionRoute', res.data.data);
      });
    },
    getRole({ commit }) {
      api.getRole().then(res =>{
        commit('getRole', res.data.data);
      });
    }
  }
};