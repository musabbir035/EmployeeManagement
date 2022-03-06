<template>
  <div>
    <validation-observer ref="observer" v-slot="{ handleSubmit }">
      <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
        <div class="row">
          <div class="col-12 col-md-6">
            <validation-provider
              name="organization"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter organization name.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-organization"
                label="Organization"
                label-for="organization"
              >
                <b-form-input
                  id="organization"
                  v-model="form.organization"
                  type="text"
                  placeholder="Enter organization name"
                  :state="getValidationState(validationContext)"
                  aria-describedby="organization-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="organization-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </div>

          <div class="col-12 col-md-6">
            <validation-provider
              name="from_date"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter start date.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-from_date"
                label="Start Date"
                label-for="from_date"
              >
                <b-form-input
                  id="from_date"
                  v-model="form.from_date"
                  type="date"
                  placeholder="Enter start date"
                  :state="getValidationState(validationContext)"
                  aria-describedby="from_date-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="from_date-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </div>

          <div class="col-12 col-md-6">
            <validation-provider
              name="to_date"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter end date.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-to_date"
                label="End Date"
                label-for="to_date"
              >
                <b-form-input
                  id="to_date"
                  v-model="form.to_date"
                  type="date"
                  placeholder="Enter end date"
                  :state="getValidationState(validationContext)"
                  aria-describedby="to_date-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="to_date-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </div>

          <div class="col-12 col-md-6">
            <validation-provider
              name="designation"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter designation.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-designation"
                label="Designation"
                label-for="designation"
              >
                <b-form-input
                  id="designation"
                  v-model="form.designation"
                  type="text"
                  placeholder="Enter designation"
                  :state="getValidationState(validationContext)"
                  aria-describedby="designation-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="designation-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </div>

          <div class="col-12">
            <validation-provider
              name="duties"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter duties .',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-duties"
                label="Duties"
                label-for="duties"
              >
                <b-form-textarea
                  id="duties"
                  v-model="form.duties"
                  placeholder="Enter duties"
                  :state="getValidationState(validationContext)"
                  aria-describedby="duties-live-feedback"
                  required
                  rows="3"
                />
                <b-form-invalid-feedback id="duties-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </div>

          <div class="col-12 mb-3 text-danger" v-if="errorMessage">
            {{ errorMessage }}
          </div>

          <div class="col-12">
            <b-button type="submit" variant="success">{{ btnText }}</b-button>
          </div>
        </div>
      </b-form>
    </validation-observer>
    <loading-spinner :backdrop="true" v-if="showFullPageLoading" />
  </div>
</template>

<script>
export default {
  props: ["experience"],

  data() {
    return {
      form: {
        id: null,
        organization: null,
        from_date: null,
        to_date: null,
        designation: null,
        duties: null,
        employee_id: null,
      },
      showFullPageLoading: false,
      btnText: "Add",
      errorMessage: null,
    };
  },

  methods: {
    onSubmit() {
      this.showFullPageLoading = true;
      if (this.experience) {
        this.$store
          .dispatch("editExperience", this.form)
          .then((res) => {
            this.showFullPageLoading = false;
            this.$emit("experience-added", res);
          })
          .catch((err) => {
            this.handleError(err);
          });
      } else {
        this.$store
          .dispatch("addExperience", this.form)
          .then((res) => {
            this.showFullPageLoading = false;
            this.$emit("experience-added", res);
          })
          .catch((err) => {
            this.handleError(err);
          });
      }
    },
    handleError(err) {
      this.showFullPageLoading = false;
      if (err.response.data.errors) {
        this.$refs.observer.setErrors(err.response.data.errors);
      } else {
        this.errorMessage = err.response.data.message;
      }
    },
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    formatDate(date) {
      // Convert "dd-mm-yyyy" to "yyyy-mm-dd"
      let d = date.split("-");
      let newDate = d[2] + "-" + d[1] + "-" + d[0];
      return newDate;
    },
  },

  mounted() {
    if (this.experience) {
      console.log(this.experience);
      this.form.id = this.experience.id;
      this.form.organization = this.experience.organization;
      this.form.from_date = this.formatDate(this.experience.from_date);
      this.form.to_date = this.formatDate(this.experience.to_date);
      this.form.duties = this.experience.duties;
      this.form.designation = this.experience.designation;
      this.btnText = "Update";
    }
    console.log(this.form);
    this.form.employee_id = this.$route.params.id;
  },
};
</script>

<style>
</style>