<template>
  <div
    class="content-wrapper"
    style="min-height: 1202.48px"
    v-loading.fullscreen.lock="fullscreenLoading"
  >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-info">
                <h3 class="cart-title">All Roles</h3>
                <div
                  class="card-tools"
                  style="position: absolute; top: 1rem; right: 0.5rem"
                >
                  <router-link
                    :to="{ name: 'RoleAdd' }"
                    class="btn btn-primary btn-sm mr-3"
                  >
                    Add <i class="fas fa-plus"></i>
                  </router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <div class="mb-3">
                  <div class="row">
                    <div class="col-md-2">
                      <strong>Search By</strong>
                    </div>
                    <div class="col-md-3">
                      <select name="" id="" class="form-control">
                        <option value="name">Name</option>
                        <option value="email">Slug</option>
                      </select>
                    </div>
                    <div class="col-md-7">
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                </div> -->
                <table
                  class="table table-bordered table-striped table-sm"
                  v-loading="loading"
                >
                  <thead>
                    <tr>
                      <th width="20%">SL</th>
                      <th width="40%">Name</th>
                      <th width="40%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(role, index) in roles.data" :key="role.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ role.name }}</td>

                      <td>
                        <router-link
                          :to="{
                            name: 'RoleEdit',
                            params: { id: role.id },
                          }"
                          class="btn btn-sm btn-success"
                          >Edit</router-link
                        >
                        <button
                          class="btn btn-sm btn-warning"
                          @click.prevent="deleteRole(role.id)"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "RoleList",
  data() {
    return {
      roles: [],
      loading: true,
      fullscreenLoading: false,
    };
  },
  created() {
    this.roleList();
  },
  methods: {
    roleList() {
      axios
        .get("role")
        .then((result) => {
          if (result.data.success == true) {
            this.roles = result.data.roles;
            this.loading = false;
          } else {
            Toast.fire({
              icon: "error",
              title: "Roles Not Found",
            });
          }
        })
        .catch((err) => {});
    },
    deleteRole(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.fullscreenLoading = true;
            axios.post("/delete-role/" + id).then((response) => {
              if (response.data.success == true) {
                this.roleList();
                this.fullscreenLoading = false;
                swalWithBootstrapButtons.fire(
                  "Deleted!",
                  "Role has been deleted.",
                  "success"
                );
              } else {
                Toast.fire({
                  icon: "error",
                  title: "Roles Not Deleted",
                });
              }
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
              "Cancelled",
              "Your imaginary file is safe :)",
              "error"
            );
          }
        });
    },
  },
};
</script>

<style scoped>
</style>
