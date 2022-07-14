<template>
  <div class="row">
    <div class="mb-4">
      <h3>Sign In to <strong>SG School</strong></h3>
      <p class="mb-4">
        Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
        adipisicing.
      </p>
      <p v-if="loginError" class="alert alert-danger" role="alert">
        <strong>{{ loginError }}</strong>
      </p>
    </div>
    <Form @submit="onLogin" :validation-schema="schemaLogin">
      <div class="form-group email-form-group">
        <label for="email" class="m-1">email</label>
        <Field
          type="email"
          class="form-control"
          id="email"
          v-model="email"
          name="email"
        />
        <p class="emailError"><ErrorMessage name="email" /></p>
      </div>
      <div class="form-group password-form-group mb-4">
        <label for="password" class="m-1">Password</label>
        <Field
          type="password"
          class="form-control"
          id="password"
          v-model="password"
          name="password"
        />
        <p class="passwordError"><ErrorMessage name="password" /></p>
      </div>
      <div class="d-flex mb-5 align-items-center">
        <span class="ml-auto">
          <a href="#" class="forgot-pass">Forgot Password ?</a>
        </span>
      </div>
      <button  class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
        Log in
      </button>
      <span class="d-block text-left my-4 text-muted"> or sign in with</span>
      <div class="social-login">
        <a href="#" class="facebook">
          <span class="icon-facebook mr-3"></span>
        </a>
        <a href="#" class="twitter">
          <span class="icon-twitter mr-3"></span>
        </a>
        <a href="#" class="google">
          <span class="icon-google mr-3"></span>
        </a>
      </div>
    </Form>
  </div>
</template>
<script>
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  watch:{
    
  },
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  methods: {   
      onLogin() {       
        this.$store.dispatch("login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {    
          console.log(response)   
          this.$emitter.emit(
            "loginEvent",
            response ? response : false
          );
          response ? this.$router.push({ name: "home" }) : false;
        });
    },
  },
  mounted(){
  //  console.log(this.loginError)
  },
  async unmounted() {
        await this.destroyTemp.delLoginError;
  },
  computed: {
    ...mapGetters(['destroyTemp']),
   
    loginError:function(){
         return this.$store.getters.loginError;      
    },
    schemaLogin() {
      return yup.object({
        email: yup.string().email().required(),
        password: yup.string().min(6).required(),
      });
    },
  },
};
</script>
<style>
</style>