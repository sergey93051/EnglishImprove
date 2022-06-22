import axios from 'axios'

export default { 
    
    actions: {        
        async register(stx,arg){ 

               if (await this.dispatch('csrf') == 204) {   
                         const response = await axios.get('api/v1/test'); 
                         console.log(response)    
                         stx.commit("register",true)   
                 }

                //  console.log(await this.dispatch('csrf'))
         }
    },
    mutations: {
          register(state,statuscode){
               state.statuscode = statuscode
          },
    },
    state:{
        statuscode:""
    },
    getters:{
        getData:function(state){    
           return state.statuscode       

        } 
    },

}; 