<template>
  <div>
    <loading-spinner v-if="!user" />
    <div v-else>
      <div class="text-right">
        <button
          class="btn btn-warning btn-sm"
          @click="isEditing = true"
          v-if="!isChangingPassword && !isEditing"
        >
          Update
        </button>
        <button
          class="btn btn-primary btn-sm"
          @click="isChangingPassword = true"
          v-if="!isChangingPassword && !isEditing"
        >
          Change Password
        </button>
      </div>

      <div class="row mt-4" v-if="!isEditing && !isChangingPassword">
        <div class="col-12 col-md-6 details-item">
          <span class="label">Name</span>
          <span>{{ user.name }}</span>
        </div>
        <div class="col-12 col-md-6 details-item">
          <span class="label">Email</span>
          <span>{{ user.email }}</span>
        </div>
      </div>

      <validation-observer
        ref="observer"
        v-slot="{ handleSubmit }"
        v-if="isEditing"
      >
        <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
          <div class="row">
            <div class="col-12 col-md-6">
              <validation-provider
                name="name"
                :rules="{ required: true }"
                :custom-messages="{
                  required: 'Please enter a name.',
                }"
                v-slot="validationContext"
              >
                <b-form-group
                  id="input-group-name"
                  label="Name"
                  label-for="name"
                >
                  <b-form-input
                    id="name"
                    v-model="user.name"
                    type="text"
                    placeholder="Enter name"
                    :state="getValidationState(validationContext)"
                    aria-describedby="name-live-feedback"
                    required
                  />
                  <b-form-invalid-feedback id="name-live-feedback">
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </div>

            <div class="col-12 col-md-6">
              <validation-provider
                name="email"
                :rules="{ required: true }"
                :custom-messages="{
                  required: 'Please enter an email address.',
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
                    v-model="user.email"
                    type="email"
                    placeholder="Enter email address"
                    :state="getValidationState(validationContext)"
                    aria-describedby="email-live-feedback"
                    required
                  />
                  <b-form-invalid-feedback id="email-live-feedback">
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </div>

            <div class="col-12 mb-3 text-danger" v-if="errorMessage">
              {{ errorMessage }}
            </div>

            <div class="col-12">
              <b-button type="submit" variant="primary">Update</b-button>
              <b-button variant="secondary" @click="isEditing = false">
                Cancel
              </b-button>
            </div>
          </div>
        </b-form>
      </validation-observer>

      <validation-observer
        ref="observer"
        v-slot="{ handleSubmit }"
        v-if="isChangingPassword"
      >
        <b-form @submit.stop.prevent="handleSubmit(changePassword)">
          <div class="row">
            <div class="col-12 col-md-6">
              <validation-provider
                name="current_password"
                :rules="{ required: true }"
                :custom-messages="{
                  required: 'Please enter your current password.',
                }"
                v-slot="validationContext"
              >
                <b-form-group
                  id="input-group-current_password"
                  label="Current Password"
                  label-for="current_password"
                >
                  <b-form-input
                    id="current_password"
                    v-model="password.current_password"
                    type="password"
                    placeholder="Enter current password"
                    :state="getValidationState(validationContext)"
                    aria-describedby="current_password-live-feedback"
                    required
                  />
                  <b-form-invalid-feedback id="current_password-live-feedback">
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </div>

            <div class="col-12 col-md-6">
              <validation-provider
                name="new_password"
                :rules="{ required: true }"
                :custom-messages="{
                  required: 'Please enter new password.',
                }"
                v-slot="validationContext"
              >
                <b-form-group
                  id="input-group-new_password"
                  label="New Password"
                  label-for="new_password"
                >
                  <b-form-input
                    id="new_password"
                    v-model="password.new_password"
                    type="password"
                    placeholder="Enter new password"
                    :state="getValidationState(validationContext)"
                    aria-describedby="new_password-live-feedback"
                    required
                  />
                  <b-form-invalid-feedback id="new_password-live-feedback">
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </div>

            <div class="col-12 col-md-6">
              <validation-provider
                name="confirm_new_password"
                :rules="{ required: true }"
                :custom-messages="{
                  required: 'Please confirm new password.',
                }"
                v-slot="validationContext"
              >
                <b-form-group
                  id="input-group-confirm_new_password"
                  label="Confirm New Password"
                  label-for="confirm_new_password"
                >
                  <b-form-input
                    id="confirm_new_password"
                    v-model="password.confirm_new_password"
                    type="password"
                    placeholder="Confirm new password"
                    :state="getValidationState(validationContext)"
                    aria-describedby="confirm_new_password-live-feedback"
                    required
                  />
                  <b-form-invalid-feedback
                    id="confirm_new_password-live-feedback"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </div>

            <div class="col-12 mb-3 text-danger" v-if="errorMessage">
              {{ errorMessage }}
            </div>

            <div class="col-12">
              <b-button type="submit" variant="primary">Submit</b-button>
              <b-button variant="secondary" @click="isChangingPassword = false">
                Cancel
              </b-button>
            </div>
          </div>
        </b-form>
      </validation-observer>

      <loading-spinner :backdrop="true" v-if="showFullPageLoading" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: null,
      showFullPageLoading: false,
      errorMessage: null,
      isEditing: null,
      isChangingPassword: null,
      password: {
        current_password: null,
        new_password: null,
        confirm_new_password: null,
      },
    };
  },

  methods: {
    onSubmit() {
      this.showFullPageLoading = true;
      this.$store
        .dispatch("updateProfile", {
          name: this.user.name,
          email: this.user.email,
        })
        .then((res) => {
          this.showFullPageLoading = false;
          this.makeToast(res.data.message, "success", "Success");
          this.isEditing = false;
        })
        .catch((err) => {
          this.handleError(err);
        });
    },
    changePassword() {
      this.showFullPageLoading = true;
      this.$store
        .dispatch("changePassword", {
          current_password: this.password.current_password,
          new_password: this.password.new_password,
          confirm_new_password: this.password.confirm_new_password,
        })
        .then((res) => {
          this.showFullPageLoading = false;
          this.makeToast(res.data.message, "success", "Success");
          this.isChangingPassword = false;
        })
        .catch((err) => {
          this.handleError(err);
        });
    },
    handleError(err) {
      this.showFullPageLoading = false;
      if (err.response.data.errors) {
        this.$refs.observer.setErrors(err.response.data.errors);
        this.errorMessage = null;
      } else {
        this.errorMessage = err.response.data.message;
      }
    },
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
  },

  mounted() {
    this.$store
      .dispatch("authCheck")
      .then((res) => {
        this.user = res.data.user;
      })
      .catch((err) => {});
  },
};
</script>

<style>
</style>