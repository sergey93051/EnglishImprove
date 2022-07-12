<template>
  <div class="container">
  <!-- Instructions -->
  <div class="row">
    <div class="alert alert-success col-md-12" role="alert" id="notes">
      <h4>NOTES</h4>
      <ul>
        <li>You will recieve a verification code on your mail. Enter that code below.</li>      
      </ul>
    </div>
    <div class="alert alert-warning col-md-12" role="alert">     
      <ul>      
        <li>If somehow, you did not recieve the verification email then <a href="#">resend the verification email</a></li>
      </ul>
    </div>

  </div>
  <!-- Verification Entry Jumbotron -->
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron text-center">
        <h2>Enter the verification code</h2>
        <form role="form">
          <div class="col-md-9 col-sm-12">
            <div class="form-group form-group-lg">
              <input type="text"  @input="inputEvent" :style="inputcolor"   class="form-control col-md-6 col-sm-6 col-sm-offset-2" name="verifyCode" v-model="verifyCode">
            </div>
            <div class="mt-1 timer">              
                <strong>{{minut}}</strong>:<strong v-if="second<10">0</strong><strong>{{second}}</strong>
            </div>
            <div class="alert alert-danger mt-2 " role="alert" v-if="secondAuthError">
                    <strong>{{secondAuthError}}</strong>
            </div>         
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    data() {
      return {
         verifyCode:"",       
         verifyCodeValue:"",
         timer:null,
         minut:4,
         second:59,      
        //  secondAuthError:"",
         inputcolor:{
           color:"black"
         }
      
        //  styleInput:{
        //      "color":red
        //  }                
      }
    },
    watch:{
      async verifyCode(value){
              if(value.length===6){                     
               await  this.$store.dispatch('loginSecondAuth',value).then((response)=>{                
                   this.$emitter.emit("loginSecondAuthEvent",response ?response : false );
                   response ? this.$router.push({ name: "home" }) : false;
               }) 
              }else if(value.length<6){
                  this.$store.getters.destroyTemp.delSecondAuthError;                             
              }
           
          
      },  
       
    },
    computed:{
        ...mapGetters(['destroyTemp']),
        secondAuthError:function(){
              if(this.$store.getters.secondAuthError.length>1){
                 this.inputcolor.color = "red"
              }else{
                 this.inputcolor.color = "black"
              }             
              return this.$store.getters.secondAuthError;
           }
        },         
        
    beforeDestroy () {
	       clearInterval(this.timer);        
     },
 
     destroyed(){

      
     },
    methods:{
        inputEvent(e){       
          e.target.value = e.target.value.match(/^([A-Za-z0-9]{0,6})/)[0]; 
        
          return this.verifyCode = e.target.value;  
        },
         countDownTimer () {                                  
                    this.timer = setInterval(() => {
                         if(this.second===0 && this.minut===0){                            
                                                
                                 clearInterval(this.timer);
                                 this.second = this.second+1;
                                 this.$emitter.emit('timeoutVerify',true);
                          }  
                          if(this.second == 0){
                                  this.second = 60;
                                  this.minut--;
                          }                         
                          this.second --;
                    }, 1000);         
                  
                
            }      
    },
    mounted() {      
       this.countDownTimer()
    },
    async unmounted() {
         await this.destroyTemp.delLoginError;
         await this.destroyTemp.delSecondAuthStatus;
    },
}
</script>
<style scoped>

   .jumbotron.text-center {
    height: 17em;
}
.timer{
  text-align: end;
}
input.form-control.col-md-6 {
    width: 50%;
    margin-right: 1em;
    display: inline;
}

div#notes {
    margin-top: 2%;
    width: 98%;
    margin-left: 1%;
}

@media (min-width: 991px) {
	.col-md-9.col-sm-12 {
    	margin-left: 12%;
	}
}
</style>
