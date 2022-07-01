import axios from 'axios'

export default { 
    
    actions: {        
        async login(stx,get){            
            //    if (await this.dispatch('csrf')) {   
                        try{
                           const response = await axios.post('/v1/login',
                             {
                               email:get.email,
                               password:get.password
                             }
                         );
                        if(response.data.success){
                            sessionStorage.setItem('email_verified',response.data.email_verified);
                            sessionStorage.setItem('_token',response.data.token);
                            sessionStorage.setItem('isAuth',true); 
                            return  response.data.success;
                        }    
                         

                        }
                        catch(err){
                             console.error(err);
                        }  
                //  }               
         }
    },
    mutations: {
        
    },
    state:{
     
    },
    getters:{
      
    },

}; 