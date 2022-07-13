
import axios from 'axios'

export default {
      
    actions: {
        async getProfile(stx,arg){ 
           
            try{
                   const response = await axios.get('/v1/get-information',{
                       headers: {
                            'Authorization': 'Bearer ' + sessionStorage.getItem('_token'),
                            "Accept": "application/json"
                         }
                   }); 
                                                 
                  if(response.status==200){
                      stx.commit('status','your profile has been updated')
s                  }

            }catch(error){                  
                console.error(error);
            }   
             
        },
       async twoAuth(stx,arg){ 
           
             try{
                    const response = await axios.put('/v1/update-2fa-state',{ 
                            'twoFa':arg.chooseSecondAuth?1:0 
                    },
                    {
                        headers: {
                             'Authorization': 'Bearer ' + sessionStorage.getItem('_token'),
                             "Accept": "application/json"
                          }
                    }
                    
                    );  
                                                  
                   if(response.status==200){
                       stx.commit('status','your profile has been updated')
                   }

             }catch(error){                  
                 console.error(error);
             }   
              
         }
    },
    mutations: {
        status(state,status){
           state.status = status
        }
    },
    state:{
       status:""  
    },
    getters:{
          profileUpdate(state){
            return  state.status
          }
    },

}; 