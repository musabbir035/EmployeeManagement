<template>
  <div>
    <validation-observer ref="observer" v-slot="{ handleSubmit }">
      <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
        <div class="row">
          <div class="col-12 col-md-6">
            <validation-provider
              name="exam"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter examination name.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-exam"
                label="Examination"
                label-for="exam"
              >
                <b-form-input
                  id="exam"
                  v-model="form.exam"
                  type="text"
                  placeholder="Enter examination name"
                  :state="getValidationState(validationContext)"
                  aria-describedby="exam-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="exam-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </div>

          <div class="col-12 col-md-6">
            <validation-provider
              name="passing_year"
              :rules="{ required: true, numeric: true }"
              :custom-messages="{
                required: 'Please enter passing year.',
                numeric: 'Please enter a valid year.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-passing_year"
                label="Passing Year"
                label-for="passing_year"
              >
                <b-form-input
                  id="passing_year"
                  v-model="form.passing_year"
                  type="text"
                  placeholder="Enter passing year"
                  :state="getValidationState(validationContext)"
                  aria-describedby="passing_year-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="passing_year-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </div>

          <div class="col-12 col-md-6">
            <validation-provider
              name="result"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter result.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-result"
                label="Result"
                label-for="result"
              >
                <b-form-input
                  id="result"
                  v-model="form.result"
                  type="text"
                  placeholder="Enter result"
                  :state="getValidationState(validationContext)"
                  aria-describedby="result-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="result-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </div>

          <div class="col-12 col-md-6">
            <validation-provider
              name="result_scale"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter result scale.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-result_scale"
                label="Result Scale"
                label-for="result_scale"
              >
                <b-form-input
                  id="result_scale"
                  v-model="form.result_scale"
                  type="text"
                  placeholder="Enter result scale"
                  :state="getValidationState(validationContext)"
                  aria-describedby="result_scale-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="result_scale-live-feedback">
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </div>

          <div class="col-12 col-md-6">
            <validation-provider
              name="institution"
              :rules="{ required: true }"
              :custom-messages="{
                required: 'Please enter institution name.',
              }"
              v-slot="validationContext"
            >
              <b-form-group
                id="input-group-institution"
                label="Institution"
                label-for="institution"
              >
                <b-form-input
                  id="institution"
                  v-model="form.institution"
                  type="text"
                  placeholder="Enter institution name"
                  :state="getValidationState(validationContext)"
                  aria-describedby="institution-live-feedback"
                  required
                />
                <b-form-invalid-feedback id="institution-live-feedback">
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
  props: ["education"],

  data() {
    return {
      form: {
        id: null,
        exam: null,
        passing_year: null,
        result: null,
        result_scale: null,
        institution: null,
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
      if (this.education) {
        this.$store
          .dispatch("editEducation", this.form)
          .then((res) => {
            this.showFullPageLoading = false;
            this.$emit("education-added", res);
          })
          .catch((err) => {
            this.handleError(err);
          });
      } else {
        this.$store
          .dispatch("addEducation", this.form)
          .then((res) => {
            this.showFullPageLoading = false;
            this.$emit("education-added", res);
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
  },

  mounted() {
    if (this.education) {
      this.form.id = this.education.id;
      this.form.exam = this.education.exam;
      this.form.passing_year = this.education.passing_year;
      this.form.result = this.education.result;
      this.form.result_scale = this.education.result_scale;
      this.form.institution = this.education.institution;
      this.btnText = "Update";
    }
    console.log(this.$route.params.id);
    this.form.employee_id = this.$route.params.id;
  },
};
</script>

<style>
</style>