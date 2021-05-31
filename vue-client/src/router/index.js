import Vue from 'vue'
import Router from 'vue-router'
import AdminDashboard from '@/components/AdminDashboard'

//auth component
import AdminLogin from '@/components/auth/AdminLogin'
import AdminRegister from '@/components/auth/AdminRegister'

//role component
import RoleAdd from '@/components/role/RoleAdd'
import RoleList from '@/components/role/RoleList'
import RoleEdit from '@/components/role/RoleEdit'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  linkActiveClass: 'active',
  routes: [
    {
      path: '/dashboard',
      name: 'AdminDashboard',
      component: AdminDashboard
    },

    //auth route
     {
      path: '/login',
      name: 'AdminLogin',
      component: AdminLogin
    },
     {
      path: '/register',
      name: 'AdminRegister',
      component: AdminRegister
    },
    //role route
     {
            path: '/role-add',
            component: RoleAdd,
            name: 'RoleAdd'
        },
         {
            path: '/role-list',
            component: RoleList,
            name: 'RoleList'
        },
        {
            path: '/role-edit/:id',
            component: RoleEdit,
            name: 'RoleEdit'
        },
  ]
})



export default router;
