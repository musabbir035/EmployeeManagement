<template>
  <div>
    <div class="card login-card mx-auto">
      <div class="card-body">
        <validation-observer ref="observer" v-slot="{ handleSubmit }">
          <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
            <validation-provider
              name="name"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter your name.',
              }"
              v-slot="validationContext"
            >
              <b-form-group id="input-group-name" label="Name" label-for="name">
                <b-form-input
                  id="name"
                  v-model="form.name"
                  type="text"
                  placeholder="Enter name"
                  required
                />
                <b-form-invalid-feedback id="name-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

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
                label="email"
                label-for="email"
              >
                <b-form-input
                  id="email"
                  v-model="form.email"
                  type="text"
                  placeholder="Enter email address"
                  required
                />
                <b-form-invalid-feedback id="email-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <validation-provider
              name="password"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter your password.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-password"
                label="password"
                label-for="password"
              >
                <b-form-input
                  id="password"
                  v-model="form.password"
                  type="password"
                  placeholder="Enter password"
                  required
                />
                <b-form-invalid-feedback id="password-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <b-button type="submit" variant="primary">Register</b-button>
          </b-form>
        </validation-observer>
        <p class="mt-2 mb-0">
          Already have an account?
          <router-link :to="{ name: 'Login' }">Login here.</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
      },
    };
  },
  methods: {
    onSubmit() {
      this.$store
        .dispatch("register", this.form)
        .then((res) => {
          this.showFullPageLoading = false;
          this.$router.push("/");
        })
        .catch((err) => {
          this.showFullPageLoading = false;
          if (err.response.data.errors) {
            this.$refs.observer.setErrors(err.response.data.errors);
          } else {
            this.authError = err.response.data.message;
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