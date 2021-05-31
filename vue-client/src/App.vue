<template>
  <div class="wrapper">
    <!-- Navbar -->
    <template
      v-if="$route.name !== 'AdminLogin' && $route.name !== 'AdminRegister'"
    >
      <admin-header></admin-header>
    </template>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <template
      v-if="$route.name !== 'AdminLogin' && $route.name !== 'AdminRegister'"
    >
      <admin-sidebar></admin-sidebar>
    </template>

    <!-- Content Wrapper. Contains page content -->
    <router-view></router-view>
    <!-- /.content-wrapper -->
    <template
      v-if="$route.name !== 'AdminLogin' && $route.name !== 'AdminRegister'"
    >
      <admin-footer></admin-footer>
    </template>
  </div>
</template>

<script>
import AdminFooter from "./components/inc/AdminFooter.vue";
import AdminHeader from "./components/inc/AdminHeader.vue";
import AdminSidebar from "./components/inc/AdminSidebar.vue";
export default {
  components: { AdminHeader, AdminFooter, AdminSidebar },
  name: "App",
};
</script>

<style>
</style>
