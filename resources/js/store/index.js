import Vuex from "vuex";
import Vue from "vue";
import employee from "./modules/employee";
import user from "./modules/user";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    user,
    employee,
  },
});
