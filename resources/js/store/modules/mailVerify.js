
import axios from 'axios'

export default {
      
    actions: {        
         verify(){                  
                const checkverifay = async () => {
                    try{
                        const response = await axios.get('/v1/check-verified',{
                            headers: {
                                'Authorization': 'Bearer ' + sessionStorage.getItem('_token'),
                                "Accept": "application/json"
                              }
                        });  
                         
                        if(response.status == 200){
                            sessionStorage.setItem('email_verified',response.data.email_verified)
                        }
                       
                 }catch(error){                  
                     console.error(error.message);
                 } 
             }
            
            if (!JSON.parse(sessionStorage.getItem('email_verified'))) {
                return checkverifay();  
            }
           
                       
         }
    },
    mutations: {
        
    },
    state:{
        
    },
    getters:{
        
    },

}; 