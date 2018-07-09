import api from '../api';

export default {
  state: {
    /** Menu list */
    menuItem: [],
    /** Menu detail */
    menuDetail: {},
  },
  mutations: {
    getMenuList(state, result) {
      state.menuItem = result.data;
    },
    getMenuDetail(state, result) {
      state.menuDetail = result.data;
    },
  },
  actions: {
    getMenuList({ commit }) {
      api.getMenuList().then(function (res) {
        commit('getMenuList', res.data);
      });
    },
    getMenuDetail({ commit }, id) {
      if (id) {
        api.getMenuDetail(id).then(function (res) {
          commit('getMenuDetail', res.data);
        });
      } else {
        commit('getMenuDetail', {'data':{
          id: '',
          title: '',
          route: '',
          parent: '',
          order: '',
          data: '',
        }});
      }
    }
  }
};
