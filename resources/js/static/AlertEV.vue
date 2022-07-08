<template>
      <div class="alert alert-warning" role="alert"  v-if="isShow">
            <strong> You have successfully created a account. </strong>
             <p>Please check your Email for complete your registration</p>
            <p><button class="btn" @click="refresh">Refresh Browser</button></p>
       </div>
</template>
<script>
export default {
     emits:['refresh'],
    data(){
       return {
           isShow:false
       }
    },
    create(){

    },
    methods:{
        refresh(){
             this.$emitter.emit('ref',true);           
        }
    },
    watch:{
        '$route'(to, from){   
        if (to.name=='login' || to.name=='register') {
             this.isShow = false
        } else{
            this.isShow = true 
        }
     } 
    }
}
</script>