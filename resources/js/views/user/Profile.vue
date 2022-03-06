<template>
  <div>
    <div class="card mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-12 col-md-6">
            <h5>My Profile</h5>
          </div>
          <div class="col-12 col-md-6 text-md-right" v-if="employee">
            <router-link
              class="btn btn-warning"
              :to="{ name: 'UserEdit', params: { id: employeeId } }"
            >
              Edit
            </router-link>
            <button @click="openDeleteEmployeeModal" class="btn btn-primary">
              Change Passowrd
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <loading-spinner v-if="isLoading" />
        <p v-else-if="errorMessage" class="text-center">{{ errorMessage }}</p>
        <div v-else>
          <div class="row">
            <div class="col-12 col-md-6 col-lg-4 details-item">
              <span class="label">Name</span>
              <span>{{ user.name }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-4 details-item">
              <span class="label">Email</span>
              <span>
                <a :href="'mailto:' + user.email">{{ user.email }}</a>
              </span>
            </div>
            <div class="col-12 col-md-6 col-lg-4 details-item">
              <span class="label">Roll</span>
              <span>{{ employee.roll }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-4 details-item">
              <span class="label">Designation</span>
              <span>{{ employee.designation }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-4 details-item">
              <span class="label">Department</span>
              <span>{{ employee.department }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    user() {
      return this.$store.state.user.authUser;
    },
  },
};
</script>

<style>
</style>