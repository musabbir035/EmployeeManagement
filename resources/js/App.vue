<template>
  <div>
    <login v-if="$route.name === 'LogIn'" />
    <main-layout />
  </div>
</template>

<script>
import Login from "./views/auth/Login.vue";
import MainLayout from "./components/MainLayout.vue";

export default {
  components: {
    Login,
    MainLayout,
  },
  mounted() {
    this.$store
      .dispatch("authCheck")
      .then((res) => {
        if (this.$route.name === "Login") {
          this.$router.push({
            name: "Home",
          });
        }
      })
      .catch((err) => {
        localStorage.removeItem("token");
        if (this.$route.name !== "Login") {
          this.$router.push({
            name: "Login",
          });
        }
      });
  },
};
</script>