<template>
     <div class="py-2 bg-primary">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-3 px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
			    		<div class="col-md-5 pr-4 d-flex topper align-items-center">
			    			<div class="icon bg-fifth mr-2 d-flex justify-content-center align-items-center"><span class="icon-map"></span></div>
						    <span class="text">198 West 21th Street, Suite 721 New York NY 10016</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon bg-secondary mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">youremail@email.com</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon bg-tertiary mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+ 1235 2355 98</span>
					    </div>
				    </div>
			    </div>
		    </div>
			  <AlertEV v-if="!isEmailVerify"/>		
		  </div>

    </div>
</template>
<script>
import AlertEV from "./AlertEV.vue";
export default {
     props:['isVerify'],
	data() {  
		 return {
			isEmailVerify:this.isVerify
		 }
	},
	watch:{
    //    '$route'(to, from){
		  
	//    }
	}, 
	components:{
          AlertEV
	},
	mounted() {	
      this.$emitter.on('loginEvent',(eventData) => {
           this.isEmailVerify =  eventData.email_verified!==undefined?eventData.email_verified:false;
      });
	  this.$emitter.on('loginSecondAuthEvent',(eventData) => {
	           this.isEmailVerify =  eventData.email_verified!==undefined?eventData.email_verified:false;
      });
	  this.$emitter.on("registerEvent", (eventData) => {      
          this.isEmailVerify = false;
      });
	}
}
</script>
<style scoped>
.bg-primary {
    background: #1eaaf1 !important;
}
.topper .text {
    width: calc(100% - 30px);
    color: rgba(255, 255, 255, 0.7);
}

</style>

