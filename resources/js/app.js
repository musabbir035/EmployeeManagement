require("./bootstrap");

import Vue from "vue";
import App from "./App.vue";
import store from "./store";
import router from "./router";
import { BootstrapVue } from "bootstrap-vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faUser } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  ValidationProvider,
  ValidationObserver,
  extend,
  localize,
} from "vee-validate";
import * as rules from "vee-validate/dist/rules";
import en from "vee-validate/dist/locale/en.json";
import LoadingSpinner from "./components/LoadingSpinner";

Object.keys(rules).forEach((rule) => {
  extend(rule, rules[rule]);
});
localize("en", en);
Vue.component("ValidationProvider", ValidationProvider);
Vue.component("ValidationObserver", ValidationObserver);
localize({
  en: {
    messages: {},
    fields: {
      password: {
        required: "Password cannot be empty!",
        max: "Are you really going to remember that?",
        min: "Password must contain at least {length} characters",
      },
    },
  },
});

library.add(faUser);
Vue.component("font-awesome-icon", FontAwesomeIcon);

Vue.use(BootstrapVue);

Vue.config.productionTip = false;
Vue.prototype.$appName = "Employee Management";

Vue.component("loading-spinner", LoadingSpinner);

Vue.mixin({
  methods: {
    makeToast(msg, variant = null, title = null) {
      this.$bvToast.toast(msg, {
        autoHideDelay: 5000,
        variant: variant,
        title: title,
      });
    },
  },
});

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount("#app");
