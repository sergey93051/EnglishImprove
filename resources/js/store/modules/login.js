import axios from 'axios'

export default { 
    
    actions: {        
        async login(stx,get){        
               if (await this.dispatch('csrf')) {   
                        try{
                           const response = await axios.post('/v1/login',
                             {
                               email:get.email,
                               password:get.password
                             }
                         ); 
                         console.log(response)
                         stx.commit("login",true) 
                        }
                        catch(err){
                             console.log(err)
                        }  
                 }

                 console.log(await this.dispatch('csrf'))
         }
    },
    mutations: {
          register(state,status){
               state.statuscode = status
          },
    },
    state:{
        statuscode:""
    },
    getters:{
        getLogStatus:function(state){    
           return state.statuscode       

        } 
    },

}; 