import AxiosInstance from "../../axios-config";

const state = {
  users: [],
  usersCount: 0,
  authUser: null,
};

const actions = {
  async login({ commit }, payload) {
    return AxiosInstance.post("/login", payload)
      .then((res) => {
        localStorage.setItem("token", res.data.auth_token);
        commit("setAuthUser", res.data.user);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async register({ commit }, payload) {
    return AxiosInstance.post("/register", payload)
      .then((res) => {
        localStorage.setItem("token", res.data.auth_token);
        commit("setAuthUser", res.data.user);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async authCheck({ commit, state }) {
    return AxiosInstance.get("/auth-check", {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    })
      .then((res) => {
        commit("setAuthUser", res.data.user);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async logout({ commit }) {
    return await AxiosInstance.get("/logout", {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    })
      .then((res) => {
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async updateProfile({ commit }, payload) {
    return await AxiosInstance.put("/users/edit", payload)
      .then((res) => {
        commit("setAuthUser", res.data.user);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async changePassword({ commit }, payload) {
    return await AxiosInstance.post("/users/change-password", payload)
      .then((res) => {
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },
};

const mutations = {
  setAuthUser: (state, user) => (state.authUser = user),
};

export default {
  state,
  actions,
  mutations,
};
