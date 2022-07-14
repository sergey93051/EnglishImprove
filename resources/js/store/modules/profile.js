
import { image } from '@vee-validate/rules';
import axios from 'axios'

export default {
      
    actions: {
        async getProfile(stx){ 
           
            try{
                   const response = await axios.get('/v1/get-information',{
                       headers: {
                            'Authorization': 'Bearer ' + sessionStorage.getItem('_token'),
                            "Accept": "application/json"
                         }
                   }); 
                                           
                  if(response.status==200){
                      const profile = response.data;
                      stx.commit('getProfile',{
                          name:profile.name,
                          surname:profile.surname,
                          age:profile.age,
                          image:profile.image,
                          phone:profile.phone,
                          phone_code:profile.phone_code,
                          twoFa:profile.twoFa,
                          address:profile.address
                     })
                 
                  }

            }catch(error){                  
                console.error(error);
            }   
             
        },
       async updateProfile(stx,arg){
    
      
        console.log(arg)
        try{
            const response = await axios.put('/v1/update-information',{
                name:arg.name,
                surname:arg.surname,
                age:arg.age,
                image:arg.image,           
                address:arg.address
            },{
                headers: {
                     'Authorization': 'Bearer ' + sessionStorage.getItem('_token'),
                     "Accept": "application/json"
                  }
            }); 
                                    
           if(response.status==200){     
            stx.commit('statusProfile','your profile has been updated')          
           }

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
                    stx.commit('statusTwoAuth','the twoAuth has been updated')
                   }

             }catch(error){                  
                 console.error(error);
             }   
              
         }
    },
    mutations: {
        statusProfile(state,status){
           state.statusProfile = status;
        },
        statusTwoAuth(state,getData){
            state.twoAuth = getData;
        },
        getProfile(state,getData){
            state.profile = getData;
        }
    },
    state:{
        statusProfile:"" ,
        statustwoAuth:"",
        profile:'' 
    },
    getters:{
          profileUpdate(state){
            return  state.statusProfile;
          },
          twoAuthupdate(state){
            return  state.statustwoAuth;
          },
          getProfileData(state){
            return state.profile;
          },
          profRemoveTemp(state){
             return  state.profileUpdate = '';
          }
    },

}; 