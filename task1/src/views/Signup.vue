<template>
  <div class="col-md-10 shadow px-0" id="signup">
    <div class="container-fluid px-0">
      <div
        class="d-flex justify-content-center align-items-center flex-md-row flex-sm-column flex-xs-column"
      >
        <section class="form-holder col-md-6 py-5 order-lg-1 order-sm-2 order-xs-2">
          <div class="container">
           
            <form action class="row">
              <div class="form-group col-md-6 col-sm-12">
                <label for="firstname" class="control-label">First Name</label>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  name="firstname"
                  id="firstname"
                  v-validate="'required|alpha'"
                  v-model="firstname"
                >
                <span class="err_msg"></span>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="username" class="control-label">Last Name</label>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  name="lastname"
                  id="lastname"
                  v-validate="'required|alpha'"
                  v-model="lastname"
                >
                <span class="err_msg"></span>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="phone" class="control-label">Phone</label>
                <input
                  type="number"
                  class="form-control form-control-sm"
                  name="phone"
                  id="phone"
                  v-validate="'required'"
                  v-model="phone"
                >
                <span class="err_msg"></span>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="email" class="control-label">Email</label>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  name="email"
                  id="email"
                  v-validate="'required|email'"
                  v-model="email"
                >
                <span class="err_msg"></span>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="password" class="control-label">Password</label>
                <input
                  type="password"
                  class="form-control form-control-sm"
                  name="password"
                  v-validate="'required|min:6'"
                  v-model="password"
                  ref="password"
                >
                <span class="err_msg"></span>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="confirmpassword" class="control-label">Confirm password</label>
                <input
                  type="password"
                  class="form-control form-control-sm"
                  name="confirmpassword"
                  id="confirmpassword"
                  v-validate="'required|confirmed:password'"
                  v-model="confirmpassword"
                >
                <span class="err_msg"></span>
              </div>
              <div class="form-group col-md-12">
                <button
                  type="submit"
                  style="background: #dc3545;"
                  class="text-white bg-red btn btn-info btn-block my-4"
                  @click.prevent="registerUser"
                  :disabled="!isComplete"
                >Register</button>
              </div>
              <div
                class="d-flex justify-content-center align-items-center pt-3 col-md-12"
                style="border-top: 1px solid #ccccccad;"
              >
                <router-link
                  tag="a"
                  to="/"
                  class="font-weight-bold"
                >ALready have an account? Login</router-link>
              </div>
            </form>
          </div>
          <footer>
            <p>
              &copy; Team Placeholder
            </p>
          </footer>
        </section>
        <section
          class="welcome-holder col-md-6 py-5 order-lg-1 order-sm-1 order-xs-1 d-none d-lg-block d-md-block d-sm-none d-xs-none"
        >
          <!-- <div class="cover"></div> -->
          <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="container">
              <h2 class="text-white pb-2 h6">
                Welcome to
                <span class="font-weight-bolder">Team Placeholder</span>
              </h2>
              <p class="text-white">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, soluta iste blanditiis id molestiae error delectus ipsum unde atque provident consequuntur quos dignissimos libero illum impedit at. Inventore, amet veritatis?

              </p>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
import { serverRequest } from "@/helper";

export default {
  data() {
    return {
      email:"",
      phone:"",
      firstname:"",
      lastname:"",
      password:"",
      confirmpassword:""
    };
  },
  computed: {
    isComplete(){
      return this.email && this.phone && this.firstname && this.lastname && this.password && this.confirmpassword
    }
  },
  methods: {
    registerUser(){
      const postObj = {
        fname: this.firstname,
        lname: this.lastname,
        email: this.email,
        phone: this.phone,
        password:this.password
      }
      serverRequest('POST','user/register', postObj)
          .then(response => {
            console.log(response)
            if(response.status == "error"){
              return this.$swal("Team Placeholder", response.message, response.status );
            }
            this.resetForm();
            return this.$swal("Team Placeholder", response.message, response.status );
          })
          .catch(error => console.log(error));
    },
    resetForm(){
      this.email ="";
      this.phone="";
      this.firstname="";
      this.lastname="";
      this.password="";
      this.confirmpassword="";
      this.$router.replace('/');
    }
  }
};
</script>

<style lang="scss">
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

#signup {
  min-height: 400px;
  border-radius: 2px;
   background: #fff;
}

.form-holder {
  border-radius: 2px 0 0 2px;

  .container {
    max-width: 100%;
  }

  form {
    background: white;
    padding: 1rem;
  }

  label,
  a {
    font-size: 12px;
  }

  a {
    text-decoration: none;
    color: #007bff9c;
  }

  .custom-checkbox .custom-control-label::before,
  .custom-checkbox
    .custom-control-input:checked
    ~ .custom-control-label::after {
    border-radius: 0.25rem;
    top: 1px;
  }

  .custom-control-input:checked ~ .custom-control-label::before {
    color: #fff;
    border-color: #e67817;
    background-color: #e67817;
  }

  footer p {
    font-size: 12px;
    position: absolute;
    bottom: 0;
    left: 26%;
    color: #6c757d;
  }

   .err_msg {
    color: red;
  }
  [aria-invalid="true"]{
    border: 1px solid red;
  }
}
.welcome-holder {
  background: #e67817;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  min-height: 505px;
  border-radius: 0 2px 2px 0;

  div.cover {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background: #673000cf;
  }

  .container-fluid {
    min-height: 400px;
  }

  .container {
    z-index: 5;
  }

  h2 {
    border-bottom: 1px solid;
    width: 300px;
  }

  p {
    font-size: 14px;
    z-index: 2;

    span {
      letter-spacing: 1px;
    }
  }

  a {
    text-decoration: none;
    font-size: 14px;
  }
}
</style>
