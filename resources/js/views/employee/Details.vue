<template>
  <div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'Employees' }">Employees</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          {{ employee ? employee.name : "Details" }}
        </li>
        <li class="breadcrumb-item ml-auto no-separator">
          <router-link
            class="btn btn-warning"
            :to="{ name: 'EmployeeEdit', params: { id: employeeId } }"
          >
            Edit
          </router-link>
        </li>
        <li class="breadcrumb-item no-separator">
          <button @click="openDeleteEmployeeModal" class="btn btn-danger">
            Delete
          </button>
        </li>
      </ol>
    </nav>

    <div class="card mt-4 mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-12 col-md-6">
            <h5>Employee Information</h5>
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
              <span>{{ employee.name }}</span>
            </div>
            <div class="col-12 col-md-6 col-lg-4 details-item">
              <span class="label">Phone</span>
              <span>
                <a :href="'tel:' + employee.phone">{{ employee.phone }}</a>
              </span>
            </div>
            <div class="col-12 col-md-6 col-lg-4 details-item">
              <span class="label">Email</span>
              <span>
                <a :href="'mailto:' + employee.email">{{ employee.email }}</a>
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

    <div class="card mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-6">
            <h5>Educations</h5>
          </div>
          <div class="col-6 text-right">
            <button
              class="btn btn-primary"
              v-b-modal.addEducationModal
              v-if="employee"
            >
              Add New
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <loading-spinner v-if="isLoading" />
            <div
              v-else-if="!educations || educations.length === 0"
              class="text-center"
            >
              No education information available
            </div>
            <div v-else>
              <div
                class="row education-item"
                v-for="(education, index) in educations"
                :key="education.id"
              >
                <div class="col-6">
                  <h6>Education {{ index + 1 }}</h6>
                </div>
                <div class="col-6 text-right">
                  <button
                    class="btn btn-sm btn-warning"
                    @click="openEditEducationModal(education)"
                  >
                    Edit
                  </button>
                  <button
                    class="btn btn-sm btn-danger"
                    @click="openDeleteEducationModal(education)"
                  >
                    Delete
                  </button>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Examination</span>
                  <span>{{ education.exam }}</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Passing Year</span>
                  <span>{{ education.passing_year }}</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Institution</span>
                  <span>{{ education.institution }}</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Result</span>
                  <span>{{ education.result }}</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Result Scale</span>
                  <span>{{ education.result_scale }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-6">
            <h5>Experiences</h5>
          </div>
          <div class="col-6 text-right">
            <button
              class="btn btn-primary"
              v-b-modal.addExperienceModal
              v-if="employee"
            >
              Add New
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <loading-spinner v-if="isLoading" />
            <div
              v-else-if="!experiences || experiences.length === 0"
              class="text-center"
            >
              No experience information available
            </div>
            <div v-else>
              <div
                class="row education-item"
                v-for="(experience, index) in experiences"
                :key="experience.id"
              >
                <div class="col-6">
                  <h6>Experience {{ index + 1 }}</h6>
                </div>
                <div class="col-6 text-right">
                  <button
                    class="btn btn-sm btn-warning"
                    @click="openEditExperienceModal(experience)"
                  >
                    Edit
                  </button>
                  <button
                    class="btn btn-sm btn-danger"
                    @click="openDeleteExperienceModal(experience)"
                  >
                    Delete
                  </button>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Organization</span>
                  <span>{{ experience.organization }}</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Date From</span>
                  <span>{{ experience.from_date }}</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Date To</span>
                  <span>{{ experience.to_date }}</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Designation</span>
                  <span>{{ experience.designation }}</span>
                </div>
                <div class="col-12 col-md-6 col-lg-4 details-item">
                  <span class="label">Duties</span>
                  <span>{{ experience.duties }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <b-modal
      id="addEducationModal"
      :title="educationModalTitle"
      size="lg"
      hide-footer
      no-close-on-backdrop
      scrollable
      @hidden="resetModal"
    >
      <education-form
        :education="beingEditedEducation"
        @education-added="onEducationAdded"
      />
    </b-modal>

    <b-modal
      id="addExperienceModal"
      :title="experienceModalTitle"
      size="lg"
      hide-footer
      no-close-on-backdrop
      scrollable
      @hidden="resetModal"
    >
      <experience-form
        :experience="beingEditedExperience"
        @experience-added="onExperienceAdded"
      />
    </b-modal>

    <b-modal
      id="deleteModal"
      :title="deleteModalTitle"
      size="sm"
      no-close-on-backdrop
      centered
      header-bg-variant="danger"
      header-text-variant="light"
      @hidden="resetModal"
    >
      <div>{{ deleteMessage }}</div>
      <template #modal-footer>
        <div class="w-100 text-right">
          <b-button
            variant="danger"
            size="sm"
            @click="deleteOperation(deleteType)"
          >
            Yes
          </b-button>
          <b-button
            variant="secondary"
            size="sm"
            @click="hideModal('deleteModal')"
          >
            No
          </b-button>
        </div>
      </template>
    </b-modal>
    <loading-spinner v-if="showFullPageLoading" :backdrop="true" />
  </div>
</template>

<script>
import EducationForm from "../../components/forms/EducationForm.vue";
import ExperienceForm from "../../components/forms/ExperienceForm.vue";

export default {
  components: { EducationForm, ExperienceForm },
  data() {
    return {
      employeeId: null,
      isLoading: true,
      beingEditedEducation: null,
      beingEditedExperience: null,
      experienceModalTitle: "Add Experience",
      educationModalTitle: "Add Education",
      errorMessage: null,
      deleteMessage: null,
      deleteType: null,
      showFullPageLoading: false,
      deleteModalTitle: null,
    };
  },
  methods: {
    resetModal() {
      this.beingEditedEducation = null;
      this.beingEditedExperience = null;
      this.experienceModalTitle = "Add Experience";
      this.educationModalTitle = "Add Education";
    },
    openEditEducationModal(education) {
      this.beingEditedEducation = education;
      this.educationModalTitle = "Edit Education";
      this.$bvModal.show("addEducationModal");
    },
    onEducationAdded(response) {
      this.$bvModal.hide("addEducationModal");
      this.makeToast(response.data.message, "success", "Success");
    },
    openEditExperienceModal(experience) {
      this.beingEditedExperience = experience;
      this.experienceodalTitle = "Edit Experience";
      this.$bvModal.show("addExperienceModal");
    },
    onExperienceAdded(response) {
      this.$bvModal.hide("addExperienceModal");
      this.makeToast(response.data.message, "success", "Success");
    },
    openDeleteEducationModal(education) {
      this.beingEditedEducation = education;
      this.deleteMessage = "Are you sure you want to delete this education?";
      this.deleteModalTitle = "Delete Education";
      this.deleteType = "education";
      this.$bvModal.show("deleteModal");
    },
    openDeleteExperienceModal(experience) {
      this.beingEditedExperience = experience;
      this.deleteMessage = "Are you sure you want to delete this experience?";
      this.deleteModalTitle = "Delete Experience";
      this.deleteType = "experience";
      this.$bvModal.show("deleteModal");
    },
    openDeleteEmployeeModal() {
      this.deleteModalTitle = "Delete Employee";
      this.deleteMessage = `Are you sure you want to delete this employee?
        All educations and experiences of this employee will also be deleted.`;
      this.deleteType = "employee";
      this.$bvModal.show("deleteModal");
    },
    hideModal() {
      this.$bvModal.hide("deleteModal");
    },
    deleteOperation(type) {
      this.hideModal();
      this.showFullPageLoading = true;

      if (type == "education") {
        this.deleteEducation();
      } else if (type == "experience") {
        this.deleteExperience();
      } else if (type == "employee") {
        this.deleteEmployee();
      }
    },
    deleteEducation() {
      this.$store
        .dispatch("deleteEducation", this.beingEditedEducation)
        .then((res) => {
          this.showFullPageLoading = false;
          this.makeToast(res.data.message, "success", "Success");
        })
        .catch((err) => {
          this.showFullPageLoading = false;
          this.makeToast(err.response.data.message, "danger", "Failed");
        });
    },
    deleteExperience() {
      this.$store
        .dispatch("deleteExperience", this.beingEditedExperience)
        .then((res) => {
          this.showFullPageLoading = false;
          this.makeToast(res.data.message, "success", "Success");
        })
        .catch((err) => {
          this.showFullPageLoading = false;
          console.log(err);
          this.makeToast(err.response.data.message, "danger", "Failed");
        });
    },
    deleteEmployee() {
      this.$store
        .dispatch("deleteEmployee", this.employeeId)
        .then((res) => {
          this.showFullPageLoading = false;
          this.$router.push({ name: "Employees" });
          localStorage.setItem("temp", res.data.message);
        })
        .catch((err) => {
          this.showFullPageLoading = false;
          console.log(err);
          this.makeToast(err.response.data.message, "danger", "Failed");
        });
    },
  },
  computed: {
    employee() {
      return this.$store.state.employee.employee;
    },
    educations() {
      return this.$store.state.employee.educations;
    },
    experiences() {
      return this.$store.state.employee.experiences;
    },
  },
  mounted() {
    if (localStorage.getItem("temp") != null) {
      this.makeToast(localStorage.getItem("temp"), "success", "Success");
      localStorage.removeItem("temp");
    }
  },
  created() {
    this.employeeId = this.$route.params.id;

    this.$store
      .dispatch("getEmployee", this.employeeId)
      .then((res) => {
        this.isLoading = false;
      })
      .catch((err) => {
        this.isLoading = false;
        if (err.response.status === 404) {
          this.errorMessage = "Employee not found.";
        } else {
          this.errorMessage = "Something went wrong.";
        }
      });
  },
};
</script>

<style>
</style>