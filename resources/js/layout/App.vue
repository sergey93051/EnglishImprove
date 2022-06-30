<template>
    <main>
         <header v-if="noPath">
              <Top :isEmailVerify='isEmailVerify' />  
              <Navbar  :isAuth='sessionAuth' />    
         </header>
         <router-view :isEmailVerify='isEmailVerify' />
    </main>
</template>

<script>
import Navbar from '../static/Navbar.vue'
import Top from '../static/Top.vue'
export default {
 
 data(){
   return {
        isEmailVerify:false,
        noPath:true,
        sessionAuth:false
   }
 },
  watch: {
  '$route'(to, from){   
        if (to.name=='noFound') {
             this.noPath = false
        } 
   }
  },
 components:{
       Navbar,
       Top 
 },
 created() {
    //  this.sessionAuth = JSON.parse(sessionStorage.getItem('isAuth'));
 },
 
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