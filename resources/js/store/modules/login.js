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

                            return  response.data;

                            }                         

                        }
                        catch(err){
                            if(err.response.status==400){
                                stx.commit("loginError",'The user Email or password is incorrect')
                            }
                            if(err.response.status==406){    
                                sessionStorage.setItem('isAuth',false);  
                                sessionStorage.setItem('_token',false);               
                                sessionStorage.setItem('getEmail',get.email); 
                                stx.commit('secondAuth',err.response.status)
                            }
                             
                        }  
                //  }               
         },
         async loginSecondAuth(stx,code){        
            //    if (await this.dispatch('csrf')) {   
                        try{
                           const response = await axios.post('/v1/login-by-code',
                             {
                               email:sessionStorage.getItem('getEmail'),
                               code:code
                             }
                         );
                        if(response.data.success){                       
                            sessionStorage.setItem('email_verified',response.data.email_verified);
                            sessionStorage.setItem('_token',response.data.token);
                            sessionStorage.setItem('isAuth',true); 
                           
                            return  response.data;
                            
                        }                         

                        }
                        catch(err){
                           
                            if(err.response.status==422){                                  
                                  stx.commit("loginError",err.response.data.message)
                            }else{
                                console.error(err)
                            }
                            
                             
                        }  
                //  }               
         }
    },
    mutations: {
        loginError(state,loginError){
            state.error = loginError
        },
        secondAuth(state,status){
            state.secondAuth = status
        }
    },
    state:{
        error:"",
        secondAuth:'off'
    },
    getters:{
        loginError(state){
            return  state.error;
        },
        secondAuthStatus(state){
            return  state.secondAuth
        }
    },

}; 