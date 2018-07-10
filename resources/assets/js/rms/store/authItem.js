import api from '../api';

export default {
  state: {
    /** Route list */
    permissionItem: [],
    /** Permission Route Item */
    permissionRouteItem: [],
  },
  mutations: {
    getPermission(state, result) {
      state.permissionItem = result;
    },
    getPermissionRoute(state, result) {
      state.permissionRouteItem = result;
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
    }
  }
};