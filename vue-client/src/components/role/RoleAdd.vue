<template>
  <div
    class="content-wrapper"
    style="min-height: 1203.6px"
    v-loading.fullscreen.lock="fullscreenLoading"
  >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Role</h3>
              </div>

              <form role="form" @submit.prevent="addRole">
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name">Role Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="category_name"
                      placeholder="Enter Role Name"
                      v-model="form.name"
                    />
                    <small style="color: red" v-if="errors['name']">{{
                      errors["name"][0]
                    }}</small>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-3"></div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
  name: "RoleAdd",
  data() {
    return {
      form: {
        name: "",
      },
      errors: {},
      fullscreenLoading: false,
    };
  },
  methods: {
    addRole() {
      axios.interceptors.request.use(
        (config) => {
          this.fullscreenLoading = true;
          return config;
        },
        (error) => {
          this.fullscreenLoading = false;
          return Promise.reject(error);
        }
      );

      axios.interceptors.response.use(
        (response) => {
          this.fullscreenLoading = true;
          return response;
        },
        (error) => {
          this.fullscreenLoading = false;
          return Promise.reject(error);
        }
      );
      axios
        .post("add-role", this.form)
        .then((result) => {
          if (result.data.success == true) {
            Toast.fire({
              icon: "success",
              title: "Role Add successfully",
            });
            this.$router.push({ name: "RoleList" });
          } else {
            Toast.fire({
              icon: "error",
              title: "Role Added Error",
            });
          }
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },
};
</script>

<style scoped>
</style>
