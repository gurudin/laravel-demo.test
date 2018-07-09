import api from '../api';

export default {
  state: {
    /** Route list */
    permissionItem: [],
  },
  mutations: {
    getPermission(state, result) {
      state.permissionItem = result;
    },
  },
  actions: {
    getPermission({ commit }) {
      api.getPermission().then(function (res) {
        commit('getPermission', res.data.data);
      });
    },
  }
};