import Vue from 'vue';
import Vuex from 'vuex';
import authItem from './authItem';
import menu from './menu';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    // AuthItem module
    authItem,
    // Menu module
    menu,
  }
});