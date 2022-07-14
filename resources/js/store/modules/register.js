import axios from 'axios'


export default { 
    
    actions: {        
        async register(stx,get){        
             //  if (await this.dispatch('csrf')) {   
                    try{
                        const response = await axios.post('/v1/register',
                            {
                               email:get.email,
                               role:get.role,
                               password:get.password
                            }
                        ); 

                         if(response.status==201){                              
                            sessionStorage.setItem('_token',response.data.token);                  
                            sessionStorage.setItem('email_verified',response.data.email_verified);
                            stx.commit('registerStatus',true); 
                         }                                           
                          
                        }
                        catch(err){
                            if (err.response.status == 422) {                                     
                                   if (err.response.data.errors['email']) {                                   
                                       stx.commit("registerError",err.response.data.errors['email'][0]);
                                   }               
                          
                            }else{
                                console.error("unconnected"+err);
                            }             
                          }  
               //  }              
         }
    },
    mutations: {
        registerStatus(state,registerStatus){
               state.registerStatus = registerStatus
          },
          registerError(state,registerError){
              state.registerError = registerError
          }
    },
    state:{
        registerStatus:null,
        registerError:null
    },
    getters:{
        getRegSuccess:function(state){ 
           return state.registerStatus;                
        },
        getRegError(state){
            return state.registerError;
        }

    },

}; 