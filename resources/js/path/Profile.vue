<template>
  <section style="background-color: #eee;">
  <div class="container py-5">
    <!-- <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div> -->
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
                <div class="main-upload">
                     <div class="custom__image-container">
                         <label id="add-img-label" for="add-single-img">+</label>
                         <input @change="onFileUpload"  type="file" id="add-single-img" accept="image/jpeg" />
                    </div>
                </div>
            <img :src="imageProfile" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            
            <h5 class="my-3">{{getProfileData.name}} {{getProfileData.surname}}</h5>
            <p class="text-muted mb-1">Full Stack Developer</p>
            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary">Follow</button>
              <button type="button" class="btn btn-outline-primary ms-1">Message</button>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning"></i>
                <p class="mb-0">https://mdbootstrap.com</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">@mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
         <Form  @submit="onChangeProfile" :validation-schema="schemaProfile">
             <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Name</p>
              </div>
              <div class="col-sm-7">
                <p class="text-muted mb-0">          
                      <Field ref="profName" name="profName" type="text" v-model="profName"  class="form-control" />         
                      <small class="errorColor"><ErrorMessage name="profName" /></small>                 
                </p>
              
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Surname</p>
              </div>
              <div class="col-sm-7">
                <p class="text-muted mb-0 "><input ref="profSurname" v-model="profSurname" type="text"  class="form-control"></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Age</p>
              </div>
              <div class="col-sm-7">
                <p class="text-muted mb-0 "><input ref="profAge" v-model="profAge" type="text"  class="form-control"></p>
              </div>
            </div>
            <hr>
            <!-- <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-7">
                <p class="text-muted mb-0"><input v-model="profEmail" type="email" class="form-control"></p>
              </div>
            </div>
            <hr>             -->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-7">
                <p class="text-muted mb-0"><input ref="profMobile" v-model="profPhone" type="text" class="form-control"></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-7">
                <p class="text-muted mb-0"><input ref="profAddress" v-model="profAddress" type="text" class="form-control"></p>
              </div> 
            </div>
             <hr>
             <div class="row">
              <div class="col-sm-5">
                <p class="mb-0">Turn on 2-Step Verification</p>
              </div>
              <div class="col-sm-7">
                <p class="text-muted mb-0"><input id="chooseSecondAuth"  class="p-1 m-1 " v-model="chooseSecondAuth" type="checkbox" name="chooseSecondAuth" /> </p>
              </div>
            </div>
            <div class="row mt-2">             
              <div class="col-sm-7 p-2">
                   <button class="btn btn-warning">change</button>
                    <strong v-if="profileUpdate" class="alert alert-success ">{{profileUpdate}}</strong>
              </div>
            </div>
          </div>
        </div>
         </Form>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                </p>
                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                </p>
                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import { Form,Field,ErrorMessage} from 'vee-validate';
import * as yup from 'yup';
export default {

   data(){
       return {
          //  profName:this.getProfileData.twoFa,
          chooseSecondAuth:false,
          imageProfile:'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp',
          bese64:'',
          profName:"",        
          profSurname:"",
          profAge:"",
          profAddress:"",
          profPhone:""

       }
   },
    computed:{
      ...mapGetters(['profileUpdate','getProfileData','profRemoveTemp']),
      schemaProfile(){
          return yup.object({
               profName:yup.string().min(2).required(),
           });
      }
    },
    components: {
              Form,
              Field,
              ErrorMessage
     },
     methods:{      
       ...mapActions(['getProfile','updateProfile']),
  
      //  check (e) {
      //    this.$nextTick(() => {
      //     console.log(e)
                  
      //     })
      //  },
      async onFileUpload(event) {
      
        const files = [...event.target.files].map(file => {
           const reader = new FileReader();      
             return new Promise(resolve => {
                reader.onload = () => resolve(btoa(reader.result));
                reader.readAsDataURL(file);
             });
         });
 
         const getNewFile = await Promise.all(files);
         this.bese64 = getNewFile[0];
      },
       async onChangeProfile(){          
           
           await this.updateProfile({       
                   name:this.profName,
                   surname:this.profSurname,
                   age:this.profAge,
                   image:this.bese64,
                   address:this.profAddress
               });
           
           await this.$store.dispatch('twoAuth',{
               chooseSecondAuth:this.chooseSecondAuth
           });            
        }
     },
    async created(){ 
          await this.getProfile();
          this.chooseSecondAuth = this.getProfileData.twoFa ? true:false; 
          this.profName = this.getProfileData.name; 
          this.profSurname =  this.getProfileData.surname;
          this.profAge = this.getProfileData.age;
          this.profAddress = this.getProfileData.address;
          this.profPhone = this.getProfileData.phone_code+' '+this.getProfileData.phone       
     },
     mounted(){          
          
     },  
     async unmounted() {
          await this.profRemoveTemp;
     },
}
</script>
<style scoped>
@import '../../css/uploadImage.css';


</style>