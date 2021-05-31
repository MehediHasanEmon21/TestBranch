<template>
  <div
    id="admin_login"
    class="hold-transition login-page"
    v-loading.fullscreen.lock="fullscreenLoading"
  >
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="javascript:void()" class="h1"><b>Admin</b>Login</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to your account</p>

          <form @submit.prevent="adminLogin">
            <div class="input-group mb-3">
              <input
                type="email"
                class="form-control"
                v-model="form.email"
                placeholder="Email"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <small style="color: red" v-if="errors['email']">{{
              errors["email"][0]
            }}</small>
            <div class="input-group mb-3">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
                v-model="form.password"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <small style="color: red" v-if="errors['password']">{{
              errors["password"][0]
            }}</small>
            <div class="row">
              <div class="col-8">
                <!-- <div class="icheck-primary">
                  <input type="checkbox" id="remember" />
                  <label for="remember"> Remember Me </label>
                </div> -->
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Sign In
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <!-- <div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div> -->
          <!-- /.social-auth-links -->

          <p class="mb-0">
            <router-link :to="{ name: 'AdminRegister' }" class="text-center"
              >Register a new account</router-link
            >
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</template>

<script>
export default {
  name: "AdminLogin",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      errors: {},
      fullscreenLoading: false,
    };
  },
  methods: {
    adminLogin() {
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

      // Add a response interceptor
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
        .post("/auth/login", this.form)
        .then((result) => {
          if (result.data.success == false) {
            this.fullscreenLoading = false;
            Toast.fire({
              icon: "error",
              title: "Email or Password Not Valid",
            });
          } else {
            localStorage.setItem(
              "admin_access_token",
              result.data.access_token
            );
            Toast.fire({
              icon: "success",
              title: "Logged In successfully",
            });
            this.$router.push({ name: "AdminDashboard" });
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
