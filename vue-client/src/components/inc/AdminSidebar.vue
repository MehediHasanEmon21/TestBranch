<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void()" class="brand-link">
      <img
        src="https://upload.wikimedia.org/wikipedia/commons/9/95/Vue.js_Logo_2.svg"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />

    </a><br>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- SidebarSearch Form -->
      <div class="form-inline">

      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link :to="{name: 'AdminDashboard'}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </router-link>

          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile

              </p>
            </a>

          </li>

           <li class="nav-item menu-open">
            <router-link :to="{name: 'RoleList'}" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Role

              </p>
            </router-link>

          </li>

           <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Assign Role

              </p>
            </a>

          </li>

          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User

              </p>
            </a>

          </li>

          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-sign-out-alt"></i>
              <p>
                Logout

              </p>
            </a>

          </li>



            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
export default {
  name: "AdminSidebar",
};
</script>

<style  scoped>
</style>
