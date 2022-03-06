import AxiosInstance from "../../axios-config";

const state = {
  employees: [],
  employeesCount: 0,
  employee: null,
  educations: [],
  experiences: [],
};

const actions = {
  async getAllEmployees({ commit, state }) {
    return await AxiosInstance.get("/employees")
      .then((res) => {
        commit("setAllEmployees", res.data.employees);
        commit(
          "updateEmployeesCount",
          state.employees ? state.employees.length : 0
        );
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async getEmployee({ commit }, id) {
    return await AxiosInstance.get("/employees/" + id)
      .then((res) => {
        commit("setEmployee", res.data.employee);
        commit("setEducations", res.data.employee.educations);
        commit("setExperiences", res.data.employee.experiences);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async addEmployee({ commit, state }, payload) {
    return await AxiosInstance.post("/employees/store", payload)
      .then((res) => {
        commit("addEmployee", res.data.employee);
        commit("updateEmployeesCount", state.employeesCount + 1);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async editEmployee({ commit }, payload) {
    return await AxiosInstance.put(`/employees/${payload.id}/update`, payload)
      .then((res) => {
        commit("editEmployee", res.data.employee);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async deleteEmployee({ commit }, id) {
    return await AxiosInstance.delete(`/employees/${id}/delete`)
      .then((res) => {
        commit("deleteEmployee", id);
        commit("updateEmployeesCount", state.employeesCount - 1);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async addEducation({ commit }, payload) {
    return await AxiosInstance.post("/educations/store", payload)
      .then((res) => {
        commit("addEducation", res.data.education);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async editEducation({ commit }, payload) {
    return await AxiosInstance.put(`/educations/${payload.id}/update`, payload)
      .then((res) => {
        commit("editEducation", res.data.education);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async deleteEducation({ commit }, education) {
    return await AxiosInstance.delete(`/educations/${education.id}/destroy`)
      .then((res) => {
        commit("deleteEducation", education);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async addExperience({ commit }, payload) {
    return await AxiosInstance.post("/experiences/store", payload)
      .then((res) => {
        commit("addExperience", res.data.experience);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async editExperience({ commit }, payload) {
    return await AxiosInstance.put(`/experiences/${payload.id}/update`, payload)
      .then((res) => {
        commit("editExperience", res.data.experience);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },

  async deleteExperience({ commit }, experience) {
    return await AxiosInstance.delete(`/experiences/${experience.id}/destroy`)
      .then((res) => {
        commit("deleteExperience", experience);
        return res;
      })
      .catch((err) => {
        throw err;
      });
  },
};

const mutations = {
  setAllEmployees: (state, employees) => (state.employees = employees),
  updateEmployeesCount: (state, count) => (state.employeesCount = count),
  addEmployee: (state, employee) => state.employees.push(employee),
  editEmployee: (state, employee) => {
    const index = state.employees.map((a) => a.id).indexOf(employee.id);
    state.employees.splice(index, 1, employee);
  },
  setEmployee: (state, employee) => (state.employee = employee),
  deleteEmployee: (state, id) => {
    const index = state.employees.map((a) => a.id).indexOf(id);
    state.employees.splice(index, 1);
  },

  setEducations: (state, educations) => (state.educations = educations),
  addEducation: (state, education) => state.educations.push(education),
  editEducation: (state, education) => {
    const index = state.educations.findIndex((u) => u.id == education.id);
    state.educations.splice(index, 1, education);
  },
  deleteEducation: (state, education) => {
    const index = state.educations.indexOf(education);
    state.educations.splice(index, 1);
  },

  setExperiences: (state, experiences) => (state.experiences = experiences),
  addExperience: (state, experience) => state.experiences.push(experience),
  editExperience: (state, experience) => {
    const index = state.experiences.findIndex((u) => u.id == experience.id);
    state.experiences.splice(index, 1, experience);
  },
  deleteExperience: (state, experience) => {
    const index = state.experiences.indexOf(experience);
    state.experiences.splice(index, 1);
  },
};

export default {
  state,
  actions,
  mutations,
};
