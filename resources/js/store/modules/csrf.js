
import axios from 'axios'

export default {
      
    actions: {        
        async csrf(){ 
            
             try{
                    const sanctum = await axios.get('/sanctum/csrf-cookie');  
                      
                    if (sanctum.status == 204) {                   
                           return sanctum.status;             
                      
                    }else{
                        throw new Error(419+'(Hacking attempt)');
                    }                  
                   
             }catch(error){                  
                  throw new Error(419+'(Hacking attempt)');
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