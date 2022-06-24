import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
       name:"home",
       path:"/",
       component:() => import('./path/Home.vue')
    },
    {
     name: "login",
     path: '/login',
     component: () => import('./auth/Login.vue'),
     // beforeEnter:checkGuest

    },
    {

      name: "register",
      path: '/register',
      component: () => import('./auth/Register.vue'),
 
    },
    {

      name: "profile",
      path: '/profile',
      component: () => import('./path/Profile.vue'),
 
    },

  // {
  //   path: "/:catchAll(.*)",
  //   name: "noFound",
  //   component: () => import('@/components/NoPath.vue')
  // },
]

function checkGuest(to, from, next){
   return  JSON.parse(sessionStorage.getItem('isAuth'))==false ?  next() : next({ name: "home" });
}

function checkAuth(to, from, next) {
  if (to.name == 'home') {
    try {
     axios.get('/api/auth/sanctum').then((response) => {
        if (response.data == true) {
          sessionStorage.setItem('isAuth',true)
          return next()
        }
        sessionStorage.setItem('isAuth',false)
        return next({ name: 'login' })
      });
    }
    catch (error) {
      sessionStorage.setItem('isAuth',false)
      return next({ name: 'login' })
    }
  }else {
    if (!JSON.parse(sessionStorage.getItem('isAuth'))) {
      return next({ name: "login" });
    }
    return next();
  }
}

export default createRouter({
  history: createWebHistory(),
  routes: routes,
})



