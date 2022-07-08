import axios from 'axios'


export default { 
    
    actions: {        
        async logout(stx){   
                        
            //    if (await this.dispatch('csrf')) {   
                    try{
                     const response = await axios.post('/v1/logout',{}, {
                            headers: {
                              'Authorization': 'Bearer ' + sessionStorage.getItem('_token'),
                              "Accept": "application/json"
                            }
                          }); 

                           if(response.data.success){
                               sessionStorage.removeItem('_token');
                               sessionStorage.setItem('email_verified',false); 
                               sessionStorage.setItem('isAuth',false); 
                                return response.data.success;
                            }
                      
                        }
                        catch(err){                                                     
                                console.error('unconnected' + err);                                                
                                 
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