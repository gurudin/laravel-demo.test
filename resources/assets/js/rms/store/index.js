import Vue from 'vue';
import Vuex from 'vuex';
import route from './route';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    // Route module
    route,
  }
});