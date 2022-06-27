import axios from 'axios'

export default { 
    
    actions: {        
        async register(stx,get){        
               if (await this.dispatch('csrf')) {   
                         const response = await axios.post('/v1/register',
                             {
                                email:get.email,
                                role:get.role,
                                password:get.password
                             }
                         ); 
                         console.log(response.data)
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