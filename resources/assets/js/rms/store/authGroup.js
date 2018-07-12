import api from '../api';

export default {
  state: {
    /** Group item */
    groupItem: [],
    /** User item */
    userItem: [],
    /** Group user child item */
    userChildItem: [],
    /** Group item child item */
    itemChildItem: [],
  },
  mutations: {
    getGroup(state, result) {
      state.groupItem = result;
    },
    getUser(state, result) {
      state.userItem = result;
    },
    getUserChildItem(state, result) {
      state.userChildItem = result;
    },
    getItemChildItem(state, result) {
      state.itemChildItem = result;
    },
  },
  actions: {
    getGroup({ commit }) {
      api.getGroup().then(function (res) {
        commit('getGroup', res.data.data);
      });
    },
    getUser({ commit }) {
      api.getUser().then(res =>{
        commit('getUser', res.data.data);
      });
    },
    getUserChildItem({ commit }, id) {
      api.getUserChildItem(id).then(res =>{
        commit('getUserChildItem', res.data.data);
      });
    },
    getItemChildItem({ commit }, id) {
      api.getItemChildItem(id).then(res => {
        commit('getItemChildItem', res.data.data);
      });
    },
  }
};