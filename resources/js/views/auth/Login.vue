<template>
  <div>
    <div class="card login-card mx-auto">
      <div class="card-body">
        <validation-observer ref="observer" v-slot="{ handleSubmit }">
          <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
            <validation-provider
              name="email"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter your email address.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-email"
                label="Email Address"
                label-for="email"
              >
                <b-form-input
                  id="email"
                  v-model="form.email"
                  type="email"
                  placeholder="Enter email"
                  :state="getValidationState(validationContext)"
                  aria-describedby="email-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="email-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <validation-provider
              name="passowrd"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter your password.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-password"
                label="Password"
                label-for="password"
              >
                <b-form-input
                  id="password"
                  v-model="form.password"
                  type="password"
                  placeholder="Enter password"
                  :state="getValidationState(validationContext)"
                  aria-describedby="password-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="password-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <p class="text-danger" v-if="errorMessage">
              {{ errorMessage }}
            </p>

            <b-button type="submit" variant="primary">Login</b-button>
          </b-form>
        </validation-observer>
        <p class="mt-2 mb-0">
          Don't have an account?
          <router-link :to="{ name: 'Register' }">Register here.</router-link>
        </p>
      </div>
    </div>
    <loading-spinner v-if="showFullPageLoading" :backdrop="true" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
      showFullPageLoading: false,
      errorMessage: null,
    };
  },
  methods: {
    onSubmit() {
      this.showFullPageLoading = true;
      this.$store
        .dispatch("login", this.form)
        .then((res) => {
          this.showFullPageLoading = false;
          this.$router.push("/");
        })
        .catch((err) => {
          this.showFullPageLoading = false;
          if (err.response.data.errors) {
            this.$refs.observer.setErrors(err.response.data.errors);
          } else {
            this.errorMessage = err.response.data.message;
          }
        });
    },
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
  },
};
</script>

<style>
</style>