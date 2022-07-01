import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    name: "home",
    path: "/",
    component: () => import('./path/Home.vue'),
    beforeEnter: checkAuth
  },
  {
    name: "login",
    path: '/login',
    component: () => import('./auth/Login.vue'),
    beforeEnter: checkGuest
  },
  {
    name: "register",
    path: '/register',
    component: () => import('./auth/Register.vue'),
    beforeEnter: checkGuest
  },
  {
    name: "profile",
    path: '/profile',
    component: () => import('./path/Profile.vue'),
    beforeEnter: checkAuth
  },

  {
    path: "/:catchAll(.*)",
    name: "noFound",
    component: () => import('./path/Nofound.vue')
  },
]

function checkGuest(to, from, next) {
  return JSON.parse(sessionStorage.getItem('isAuth')) == false ? next() : next({ name: "home" });
}

function checkAuth(to, from, next) {
  if (to.name == 'home') {
    axios.get('/v1/check-verified', {
      headers: {
        'Authorization': 'Bearer ' + sessionStorage.getItem('_token'),
        "Accept": "application/json"
      }
    }).then((response) => {

      if (response.status == 200) {
        sessionStorage.setItem('isAuth', true);
        return next();
      } else {
        console.error("unconnected");
        return next({ name: 'login' })
      }
    }).catch((error)=>{
      sessionStorage.setItem('isAuth', false);
      return next({ name: 'login' });
    });    
  } else {
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



