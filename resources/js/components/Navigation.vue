<template>
  <div>
    <b-navbar fixed="top" variant="primary" type="dark">
      <b-navbar-brand v-if="!isMobile" :to="{ name: 'Home' }">
        {{ $appName }}
      </b-navbar-brand>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="mr-auto">
          <b-nav-item :to="{ name: 'Employees' }">Employees</b-nav-item>
        </b-navbar-nav>
        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown right no-caret>
            <template #button-content>
              <span v-b-tooltip.hover title="Account">
                <font-awesome-icon icon="fa-solid fa-user" />
                <span class="ml-1">{{ authUserName }}</span>
              </span>
            </template>
            <b-dropdown-item @click="$bvModal.show('userDetailsModal')">
              Profile
            </b-dropdown-item>
            <b-dropdown-item href="#" @click="logout">Sign Out</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>

    <b-sidebar
      id="sidebar-1"
      :shadow="isMobile"
      :visible="!isMobile"
      no-header
      :no-close-on-route-change="!isMobile"
      v-model="showSidebar"
    >
      <div v-if="isMobile" class="sidebar-brand">
        <a
          href="javascript:void(0)"
          class="link-icon nav-link"
          @click="sidebarToggle"
          v-b-tooltip.hover
          title="Toggle sidebar"
        >
          <b-icon icon="list"></b-icon>
        </a>
        <router-link to="/">{{ $appName }}</router-link>
      </div>
    </b-sidebar>

    <b-modal
      id="userDetailsModal"
      title="User Details"
      size="md"
      hide-footer
      no-close-on-backdrop
      scrollable
    >
      <user-details />
    </b-modal>
  </div>
</template>

<script>
import UserDetails from "./UserDetails.vue";
export default {
  components: { UserDetails },
  data() {
    return {
      showSidebar: null,
      isMobile: null,
    };
  },
  methods: {
    sidebarToggle() {},
    logout() {
      this.$store.dispatch("logout").then((res) => {
        //this.showFullPageLoading = false;
        localStorage.removeItem("token");
        this.$router.push({
          name: "Login",
        });
      });
    },
  },
  computed: {
    authUserName() {
      if (this.$store.state.user.authUser) {
        return this.$store.state.user.authUser.name;
      }
      return;
    },
    authUser() {
      if (this.$store.state.user.authUser) {
        return this.$store.state.user.authUser;
      }
      return;
    },
  },
};
</script>

<style>
</style>