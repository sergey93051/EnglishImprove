import axios from 'axios'

export default { 
    
    actions: {        
        async register(stx,get){        
               if (await this.dispatch('csrf')) {   
                    try{
                        const response = await axios.post('/v1/register',
                            {
                               email:get.email,
                               role:get.role,
                               password:get.password
                            }
                        ); 
                         console.log(response)
                        stx.commit("register",true) 
                        }
                        catch(err){
                            if (err.response.status == 422) {                                     
                                   if (err.response.data.errors['email']) {                                   
                                       stx.commit("registerError",err.response.data.errors['email'][0]);
                                   }                           
                          
                            }else{
                                console.error("unconnected");
                            }             
                          }  
                 }

                 console.log(await this.dispatch('csrf'))
         }
    },
    mutations: {
          register(state,statuscode){
               state.statuscode = statuscode
          },
          registerError(state,error){
              state.statuscode = error
          }
    },
    state:{
        statuscode:"",
        error:[]
    },
    getters:{
        getRegData:function(state){    
            return state.statuscode
        },
        getRegError(state){
            return state.error;
        }

    },

}; 