<template>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img
            src="/storage/image/login_img/login.svg"
            alt="Image"
            class="img-fluid"
          />
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
             
                <component :is="loginComponent" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import Form from './LoginForm.vue';
import EmailVerify from './emailVerify.vue';
export default {
    data(){
       return {
          component:Form, 
       }
    },
    components:{},
    computed:{
        ...mapGetters(['loginError','secondAuthStatus','destroyTemp']),
        loginComponent(){
            return this.component     
        }
    },
    created() {
      // this.destroyTemp.delLoginError;
    },
    mounted(){        
        this.$emitter.on('loginEvent',(event)=>{
                 console.log(this.secondAuthStatus)
              if(this.secondAuthStatus==406){
                    this.component = EmailVerify;  
              }                     
        });
        this.$emitter.on('timeoutVerify',(event)=>{
           event ? this.component = Form :null
        });
    },
    
}
</script>
<style>
@import '../../../css/login.css';


</style>