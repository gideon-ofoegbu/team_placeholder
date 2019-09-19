<template>
  <div class="col-md-10 shadow px-0" id="login">
    <div class="container-fluid px-0">
      <div
        class="d-flex justify-content-center align-items-center flex-md-row flex-sm-column flex-xs-column"
      >
        <section class="form-holder col-md-6 py-5 order-lg-1 order-sm-2 order-xs-2">
          <div class="container">
            <form action>
              <div class="form-group">
                <label for="phone" class="control-label">Phone number</label>
                <input
                  class="form-control form-control-sm"
                  id="phone"
                  v-validate="'required'" name="phone" type="number"
                  v-model="phone"
                >
                <span class="err_msg">{{ errors.first('phone') }}</span>
              </div>
              <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input
                  class="form-control form-control-sm"
                  id="password"
                  v-validate="'required|min:6'" name="password" type="password"
                  v-model="password"
                >
                <span class="err_msg">{{ errors.first('password') }}</span>
              </div>
              <div class="form-group">
                <button
                  type="submit"
                  style="background: #dc3545;"
                  class="text-white bg-red btn btn-info btn-block my-4"
                   @click.prevent="authenticateUser"
                  :disabled="!isComplete"
                >Log in</button>
              </div>
              <div class="remember-me-cont"></div>
              <div class="d-flex align-items-center justify-content-between pb-3">
                <div class="form-check-inline">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      id="customCheck"
                      name="remember"
                      checked
                    >
                    <label class="custom-control-label" for="customCheck">Remember me</label>
                  </div>
                </div>
                <div class="form-check-inline">
                  <router-link
                    tag="a"
                    to="/"
                    class="font-weight-bold"
                  >Forget password</router-link>
                </div>
              </div>
              <div
                class="d-flex justify-content-center align-items-center pt-3"
                style="border-top: 1px solid #ccccccad;"
              >
                <router-link tag="a" to="/signup" class="font-weight-bold">Register New User?</router-link>
              </div>
            </form>
          </div>
          <footer>
            <p>
              &copy; Team Placeholder |
              <router-link tag="a" to="/">Terms and condition</router-link>
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
               Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam, consequatur. Commodi, expedita iusto incidunt aperiam rem, vero similique non eveniet, neque sit quisquam? Asperiores rerum omnis molestiae nobis repellat. Adipisci.
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
import { mapState } from 'vuex';

export default {
  data() {
    return {
      phone: "",
      password: "",
    };
  },
  computed: {
    isComplete(){
      return this.phone && this.password && this.password.length > 5
    },    
    ...mapState({
      isLoggin: state => state.auth.user,
    })
  },
  watch: { 
    // isLoggin: function(newVal, oldVal) {
    //   if(newVal){
    //     this.$router.push({ path: 'dashboard' });
    //   }
    // }
  },
  methods: {
    authenticateUser(){
      const postObj = {
        phone: this.phone,
        password: this.password
      }
      serverRequest('POST','user/login', postObj)
          .then(response => {
            console.log(response);
            if(response.status == "error"){
              return this.$swal("Team Placeholder", response.message, response.status)
            }
            //dispatch action here
            this.$store.dispatch('auth/userAuthenticated', response.data);
            //set localstorage
            this.$setItem('user', response.data, (res)=> console.log("store set", res));
            //naviage to dashboard from watch
          })
          .catch(error => console.error(error));
    }
  },
  async mounted() {
    // const user = await this.$getItem('user').then((value) => value ).catch((err) => null );
    // this.$store.dispatch('auth/userAuthenticated', user);
    // if(this.isLoggin){
    //   this.$router.push({ path: 'dashboard' });
    // }
  }
};
</script>

<style lang="scss" scoped>
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

#login {
  min-height: 400px;
  border-radius: 2px;
  background: #fff;
}

.form-holder {
  border-radius: 2px 0 0 2px;
  
  .container {
    width: 400px;
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
   min-height: 400px;
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
