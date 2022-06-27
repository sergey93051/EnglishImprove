<template>
    <div class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>
              <Form @submit="onRegister" :validation-schema="schemaRegister" >
                <div class="form-outline mb-4">
                  <label class="form-label" for="email">Your Email</label>
                   <Field type="email" id="email" v-model="email" class="form-control form-control-lg" name="email" />                 
                   <p class="emailError"><ErrorMessage name="email" /></p>
                </div>
               <div class="form-outline mb-4">
                 <label class="form-label" for="chooseRole">Choose Your Roles</label>
                <select name="chooseRole" class="form-control" data-style="btn-primary" v-model="chooseRole" id="chooseRole">
                     <option value="Teacher">Teacher</option>
                     <option value="Student" selected>Student</option>
                </select>
              </div>
                <div class="form-outline mb-4">
                   <label class="form-label" for="password">Password</label>
                   <Field type="password" id="password" v-model="password"  class="form-control form-control-lg"  name="password" />   
                   <p class="passwordError"><ErrorMessage name="password" /></p>
                </div>
                <!-- <div class="form-outline mb-4">
                  <Field type="password" id="form3Example4cdg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                </div> -->
                <!-- <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div> -->
                <div class="d-flex justify-content-center">
                  <button class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>
                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                    class="fw-bold text-body"><u>Login here</u></a></p>
              </Form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
import { mapActions } from 'vuex';
import { Form,Field,ErrorMessage} from 'vee-validate';
import * as yup from 'yup';
// import { required, email, min } from '@vee-validate/rules';
// import { defineRule } from 'vee-validate';
export default {  
      data() {
           return{
               email:"",
               password:"",
               chooseRole:""
           }
      
        //  console.log(this.$store.dispatch('register'))
        //  this.$store.dispatch('')
        //  defineRule('required', required);
        //  defineRule('email', email);
        //  defineRule('min', min);
        //   const simpleSchema = { 
       //           password: 'required|min:8',
     
       // };
       // return {
       //   simpleSchema,
      // };
  },

components: {
    Form,
    Field,
    ErrorMessage
  },
  computed:{
   schemaRegister() {
      return yup.object({
           email:yup.string().email().required(),
           password: yup.string().min(6).required(),
      });
    },
  },
  beforeCreate(){
        
  },
  created(){    
       console.log(this.$store.getters.getData)
  },
  methods: {
    onRegister() {  
      this.$store.dispatch('register',{
          email:this.email,
          role:this.chooseRole,
          password:this.password
      });

    },
  }, 
}
</script>
<style scoped>
.emailError>span,.passwordError>span {
    color: red;
}
.card{
    border-radius: 15px;
    margin-top: 15px;
}
.gradient-custom-3 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
}
.gradient-custom-4 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
}
</style>