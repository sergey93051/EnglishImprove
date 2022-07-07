<template>
    <main>
         <header v-if="noPath">
              <Top :isVerify='isEmailVerify'/>  
              <Navbar  :isAuth='sessionAuth' :isVerify='isEmailVerify' />    
         </header>
         <router-view />
    </main>
</template>

<script>
import Navbar from '../static/Navbar.vue'
import Top from '../static/Top.vue'

export  default {

 data(){
   return {
        noPath:true,
        sessionAuth:JSON.parse(sessionStorage.getItem('isAuth')),
        isEmailVerify:JSON.parse(sessionStorage.getItem('email_verified')) 
   }
 },
  watch: {
  '$route'(to, from){  
        if (to.name=='noFound') {
             this.noPath = false
        } 
     //   this.sessionAuth = JSON.parse(sessionStorage.getItem('isAuth')),
     //   this.isEmailVerify = JSON.parse(sessionStorage.getItem('email_verified'))        
   }
  },
  computed:{
    
  },
 components:{
       Navbar,
       Top 
 },
 methods:{
    
 },
 created() {
   
//     this.sessionAuth = JSON.parse(sessionStorage.getItem('isAuth')),
//     this.isEmailVerify = JSON.parse(sessionStorage.getItem('email_verified'))
 },
 mounted(){ 
    this.$emitter.on('ref',($a) => {
              window.location.reload();
    });
 }
 
};
</script>
<style>
  body{
    font-family: "Work Sans", Arial, sans-serif;
    font-size: 16px;
    line-height: 1.8;
    font-weight: 400;
  }
  .py-2 {
    padding-top: 0.5rem !important;
}
</style>