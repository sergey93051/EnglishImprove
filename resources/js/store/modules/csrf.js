
import axios from 'axios'

export default {
      
    actions: {        
        async csrf(){ 
            
             try{
                    const sanctum = await axios.get('/sanctum/csrf-cookie');  
                      
                    if (sanctum.status == 204) {                   
                           return true;    
                     }
                    throw new SyntaxError(419+'(Hacking attempt)');                                
                   
             }catch(error){                  
                 console.error(error.message);
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