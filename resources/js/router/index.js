import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Login from "../views/auth/Login.vue";
import Register from "../views/auth/Register.vue";
import EmployeeIndex from "../views/employee/Index.vue";
import EmployeeAdd from "../views/employee/Add.vue";
import EmployeeDetails from "../views/employee/Details.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { title: "Home" },
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
    meta: { title: "Login" },
  },
  {
    path: "/register",
    name: "Register",
    component: Register,
    meta: { title: "Register" },
  },
  {
    path: "/employees",
    name: "Employees",
    component: EmployeeIndex,
    meta: { title: "Employees" },
  },
  {
    path: "/employees/add",
    name: "EmployeeAdd",
    component: EmployeeAdd,
    meta: { title: "Add New Employee" },
  },
  {
    path: "/employees/edit/:id",
    name: "EmployeeEdit",
    component: EmployeeAdd,
    meta: { title: "Edit Employee" },
  },
  {
    path: "/employees/:id",
    name: "EmployeeDetails",
    component: EmployeeDetails,
    meta: { title: "Employee Details" },
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

const DEFAULT_TITLE = "Employee Management";
router.afterEach((to, from) => {
  Vue.nextTick(() => {
    document.title = to.meta.title
      ? to.meta.title + " | " + DEFAULT_TITLE
      : DEFAULT_TITLE;
  });
});

// auth guard
router.beforeEach((to, from, next) => {
  if (localStorage.getItem("token") != null) {
    if (to.name === "Login" || to.name === "Register") {
      next({ name: "Home" });
    } else {
      next();
    }
  } else {
    if (to.name !== "Login" && to.name !== "Register") {
      next({ name: "Login" });
    } else {
      next();
    }
  }
});

export default router;
