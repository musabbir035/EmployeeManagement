<template>
  <div>
    <nav aria-label="breadcrumb mt-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Employees</li>
        <li class="breadcrumb-item ml-auto no-separator" aria-current="page">
          <router-link class="btn btn-primary" :to="{ name: 'EmployeeAdd' }">
            Add New
          </router-link>
        </li>
      </ol>
    </nav>
    <div class="card mt-4">
      <div class="card-body">
        <loading-spinner
          v-if="loadingStatus || showFullPageLoading"
          :backdrop="showFullPageLoading"
        />
        <div v-else>
          <b-row class="mb-3">
            <b-col sm="12" md="5" lg="3">
              <b-input-group size="sm">
                <b-form-input
                  id="filter-input"
                  v-model="filter"
                  type="search"
                  placeholder="Type to search customers..."
                ></b-form-input>
              </b-input-group>
            </b-col>
          </b-row>
          <b-row
            class="mt-4"
            v-if="$store.state.employee.employeesCount > perPage"
          >
            <b-col sm="7" md="6" lg="4" class="my-1">
              <b-pagination
                v-model="currentPage"
                :total-rows="employeesCount"
                :per-page="perPage"
                align="fill"
                size="sm"
                class="my-0"
              ></b-pagination>
            </b-col>
          </b-row>
          <div class="table-responsive">
            <b-table
              striped
              :items="employees"
              :fields="tableFields"
              :filter="filter"
              :current-page="currentPage"
              :per-page="perPage"
              stacked="sm"
            >
              <template #cell(name)="row">
                <router-link
                  :to="{ name: 'EmployeeDetails', params: { id: row.item.id } }"
                >
                  {{ row.item.name }}
                </router-link>
              </template>
              <template #cell(phone)="row">
                <a :href="'tel:' + row.item.phone">{{ row.item.phone }}</a>
              </template>
              <template #cell(email)="row">
                <a :href="'mailto:' + row.item.email">{{ row.item.email }}</a>
              </template>
              <template #cell(actions)="row">
                <b-button
                  size="xs"
                  class="mr-1 mt-1"
                  variant="info"
                  :to="{ name: 'EmployeeDetails', params: { id: row.item.id } }"
                >
                  Details
                </b-button>
                <b-button
                  size="xs"
                  class="mr-1 mt-1"
                  variant="warning"
                  :to="{ name: 'EmployeeEdit', params: { id: row.item.id } }"
                >
                  Edit
                </b-button>
                <b-button
                  size="xs"
                  @click="openDeleteModal(row.item)"
                  class="mt-1"
                  variant="danger"
                >
                  Delete
                </b-button>
              </template>
            </b-table>
          </div>
        </div>
      </div>
    </div>

    <b-modal
      id="deleteModal"
      title="Deleting Employee"
      size="sm"
      no-close-on-backdrop
      centered
      header-bg-variant="danger"
      header-text-variant="light"
    >
      <div>
        Are you sure you want to delete employee:
        <strong>
          {{ beingDeletedEmployee ? beingDeletedEmployee.name : "" }}? </strong
        >All educations and experiences of this employee will also be deleted.
      </div>
      <template #modal-footer>
        <div class="w-100 text-right">
          <b-button variant="danger" size="sm" @click="deleteEmployee">
            Yes
          </b-button>
          <b-button
            variant="secondary"
            size="sm"
            @click="$bvModal.hide('deleteModal')"
          >
            No
          </b-button>
        </div>
      </template>
    </b-modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tableFields: [
        {
          key: "name",
          sortable: true,
        },
        {
          key: "phone",
          sortable: true,
        },
        {
          key: "email",
          sortable: true,
        },
        {
          key: "designation",
          sortable: true,
        },
        {
          key: "department",
          sortable: true,
        },
        {
          key: "actions",
        },
      ],
      filter: null,
      currentPage: 1,
      perPage: 20,
      loadingStatus: true,
      beingDeletedEmployee: null,
      showFullPageLoading: null,
    };
  },
  computed: {
    employees() {
      return this.$store.state.employee.employees;
    },
    employeesCount() {
      return this.$store.state.employee.employeesCount;
    },
  },
  methods: {
    openDeleteModal(item) {
      this.beingDeletedEmployee = item;
      this.$bvModal.show("deleteModal");
    },
    deleteEmployee() {
      this.showFullPageLoading = true;
      this.$bvModal.hide("deleteModal");
      this.$store
        .dispatch("deleteEmployee", this.beingDeletedEmployee.id)
        .then((res) => {
          this.showFullPageLoading = false;
          this.makeToast(res.data.message, "success", "Success");
        })
        .catch((err) => {
          this.showFullPageLoading = false;
          this.makeToast(err.response.data.message, "danger", "Failed");
        });
    },
  },
  mounted() {
    if (localStorage.getItem("temp") != null) {
      this.makeToast(localStorage.getItem("temp"), "success", "Success");
      localStorage.removeItem("temp");
    }
  },
  created() {
    this.$store
      .dispatch("getAllEmployees")
      .then((res) => {
        this.loadingStatus = false;
      })
      .catch((err) => {
        this.loadingStatus = false;
        if (this.customersCount <= 0) {
          this.errorMessage = "Something went wrong";
        }
      });
  },
};
</script>

<style>
</style>