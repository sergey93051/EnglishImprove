<template>
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>  
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
      <li class="nav-item">
            <router-link :to="{name: 'login'}" class="nav-link">Sign In</router-link>
      </li>
      <li class="nav-item">
            <router-link :to="{name: 'register'}"  class="nav-link">Sign up</router-link>
      </li>
    </ul>
  </div>
</nav>
</div>

</template>
<style scoped>
.navbar-expand-lg .navbar-collapse {
  
    display: flex !important;
    justify-content: flex-end;

}
/* .ftco-navbar-light .navbar-nav > .nav-item > .nav-link {
    font-size: 15px;
    padding-top: 2.3rem;
    padding-bottom: 2.3rem;
    padding-left: 20px;
    padding-right: 20px;
    font-weight: 400;
    color: #000000;
    opacity: 1 !important;
    z-index: 2;
} */
.navbar{
   height: 100px;
}
/* .ftco-navbar-light {
    background: transparent red !important;
    z-index: -1;
    padding: 0;
} */
</style>
<script>
import { mapGetters } from "vuex";
export default {
  // props: ["isLogged"],   
   
  data() {
    return {
      isLoggedIn:true
    };
  },
  watch: {
  '$route'(to, from){
       if(JSON.parse(sessionStorage.getItem('isAuth'))){
            // this.isLoggedIn = true;  
       }   
   }
  },
  created(){
      
  },
  unmounted () {  
       
  },
  computed: {
    
  }, 
  methods: { 
    
    onLoginSuccess(){
        this.isLoggedIn = true;     
    }, 
    onhope(val) {    
      this.thisCartsCount = val;
    },
    logout(e) {
      e.preventDefault();        
       this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post("/api/logout")
          .then((response) => {
            if (response.data == 200) {
                 sessionStorage.setItem('isAuth',false) 
                 this.isLoggedIn = false;    
                 this.$router.push({ name: "login" });
            } else {
                 console.log(response);
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>
<style scope>
   
</style>