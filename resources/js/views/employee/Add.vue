<template>
  <div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'Employees' }">Employees</router-link>
        </li>
        <li class="breadcrumb-item" v-if="employee">
          <router-link :to="{ name: 'EmployeeDetails', params: employee.id }">
            {{ employee.name }}
          </router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          {{ employee ? "Edit" : "Add New" }}
        </li>
      </ol>
    </nav>

    <div class="card mt-4">
      <div class="card-body">
        <p class="text-danger" v-if="editErrorMessage">
          {{ editErrorMessage }}
        </p>
        <validation-observer ref="observer" v-slot="{ handleSubmit }" v-else>
          <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-4">
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
                      v-model="form.name"
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

              <div class="col-12 col-md-6 col-lg-4">
                <validation-provider
                  name="phone"
                  :rules="{ required: true }"
                  :custom-messages="{
                    required: 'Please enter a phone number.',
                  }"
                  v-slot="validationContext"
                >
                  <b-form-group
                    id="input-group-phone"
                    label="Phone Number"
                    label-for="phone"
                  >
                    <b-form-input
                      id="phone"
                      v-model="form.phone"
                      type="text"
                      placeholder="Enter phone number"
                      :state="getValidationState(validationContext)"
                      aria-describedby="phone-live-feedback"
                      required
                    />
                    <b-form-invalid-feedback id="phone-live-feedback">
                      {{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </div>

              <div class="col-12 col-md-6 col-lg-4">
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
                      v-model="form.email"
                      type="text"
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

              <div class="col-12 col-md-6 col-lg-4">
                <validation-provider
                  name="roll"
                  :rules="{ required: true }"
                  :custom-messages="{
                    required: 'Please enter roll.',
                  }"
                  v-slot="validationContext"
                >
                  <b-form-group
                    id="input-group-roll"
                    label="Roll"
                    label-for="roll"
                  >
                    <b-form-input
                      id="roll"
                      v-model="form.roll"
                      type="text"
                      placeholder="Enter roll"
                      :state="getValidationState(validationContext)"
                      aria-describedby="roll-live-feedback"
                      required
                    />
                    <b-form-invalid-feedback id="roll-live-feedback">
                      {{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </div>

              <div class="col-12 col-md-6 col-lg-4">
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

              <div class="col-12 col-md-6 col-lg-4">
                <validation-provider
                  name="department"
                  :rules="{ required: true }"
                  :custom-messages="{
                    required: 'Please enter department.',
                  }"
                  v-slot="validationContext"
                >
                  <b-form-group
                    id="input-group-department"
                    label="Department"
                    label-for="department"
                  >
                    <b-form-input
                      id="department"
                      v-model="form.department"
                      type="text"
                      placeholder="Enter department"
                      :state="getValidationState(validationContext)"
                      aria-describedby="department-live-feedback"
                      required
                    />
                    <b-form-invalid-feedback id="department-live-feedback">
                      {{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </div>

              <div class="col-12 mb-3 text-danger" v-if="errorMessage">
                {{ errorMessage }}
              </div>
              <div class="col-12">
                <b-button type="submit" variant="primary">
                  {{ submitBtnText }}
                </b-button>
              </div>
            </div>
          </b-form>
        </validation-observer>
      </div>
    </div>
    <loading-spinner :backdrop="true" v-if="showFullPageLoading" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null,
        email: null,
        phone: null,
        roll: null,
        designation: null,
        department: null,
      },
      employeeId: null,
      employee: null,
      showFullPageLoading: false,
      errorMessage: null,
      editErrorMessage: null,
      submitBtnText: "Add",
    };
  },
  methods: {
    onSubmit() {
      this.showFullPageLoading = true;
      if (this.employee) {
        this.form.id = this.employeeId;
        console.log(this.form);
        this.$store
          .dispatch("editEmployee", this.form)
          .then((res) => {
            this.handleSuccess(res);
          })
          .catch((err) => {
            this.showFullPageLoading = false;
            this.handleError(err);
          });
      } else {
        this.$store
          .dispatch("addEmployee", this.form)
          .then((res) => {
            this.handleSuccess(res);
          })
          .catch((err) => {
            this.showFullPageLoading = false;
            this.handleError(err);
          });
      }
    },
    handleSuccess(res) {
      this.showFullPageLoading = false;
      localStorage.setItem("temp", res.data.message);
      this.$router.push({
        name: "EmployeeDetails",
        params: { id: res.data.employee.id },
      });
    },
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    handleError(err) {
      if (err.response.data.errors) {
        this.$refs.observer.setErrors(err.response.data.errors);
      } else {
        this.errorMessage = err.response.data.message;
      }
    },
  },
  created() {
    this.employeeId = this.$route.params.id ?? null;

    if (this.employeeId) {
      this.submitBtnText = "Update";

      this.$store
        .dispatch("getEmployee", this.employeeId)
        .then((res) => {
          this.employee = res.data.employee;
          this.form.name = this.employee.name;
          this.form.email = this.employee.email;
          this.form.phone = this.employee.phone;
          this.form.roll = this.employee.roll;
          this.form.designation = this.employee.designation;
          this.form.department = this.employee.department;
        })
        .catch((err) => {
          if (err.response.status === 404) {
            this.editErrorMessage = "Employee not found.";
          } else {
            this.editErrorMessage = "Something went wrong.";
          }
        });
    }
  },
};
</script>

<style>
</style>