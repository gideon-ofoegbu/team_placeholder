<template>
  <div class="col-md-10 shadow px-0" id="forget">
    <div class="container-fluid px-0">
      <div
        class="d-flex justify-content-center align-items-center flex-md-row flex-sm-column flex-xs-column"
      >
        <section class="form-holder col-md-6 py-5 order-lg-1 order-sm-2 order-xs-2">
          <div class="container">
            <figure>
              <router-link tag="a" to="/">
                <img src="@/assets/logo/plogo192x54.png" alt srcset>
              </router-link>
            </figure>
            <form action>
              <div class="form-group">
                <label for="email" class="control-label">Enter email to recover your account</label>
                <input
                  type="email"
                  class="form-control form-control-sm"
                  name="email"
                  id="email"
                  v-validate="'required|email'"
                  v-model="email"
                >
                <span class="err_msg">{{ errors.first('email') }}</span>
              </div>
              <div class="form-group">
                <button
                  type="submit"
                  style="background: #dc3545;"
                  class="text-white bg-red btn btn-info btn-block my-4"
                  @click.prevent="sendMail"
                  :disabled="!isComplete"
                >Verify</button>
              </div>
              <div
                class="d-flex justify-content-center align-items-center pt-3"
                style="border-top: 1px solid #ccccccad;"
              >
                <router-link tag="a" to="/signup" class="font-weight-bold">Register New User?</router-link>
              </div>
              <div class="d-flex justify-content-center align-items-center pt-3">
                <router-link
                  tag="a"
                  to="/login"
                  class="font-weight-bold"
                >Already have an account? Login</router-link>
              </div>
            </form>
          </div>
          <footer>
            <p>
              &copy; Pebblevest. All righsts reserved |
              <router-link tag="a" to="/privacy">Privacy Policy</router-link>
            </p>
          </footer>
        </section>
        <section
          class="welcome-holder col-md-6 py-5 order-lg-1 order-sm-1 order-xs-1 d-none d-lg-block d-md-block d-sm-none d-xs-none"
        >
          <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="container">
              <h2 class="text-white pb-2 h6">
                Welcome to
                <span class="font-weight-bolder">Pebblevest</span>
              </h2>
              <p class="text-white">
                This is a sample text just for loreum ipsium purpose
                This is a sample text just for loreum ipsium purpose
                This is a sample text just for loreum ipsium purpose
                This is a sample text just for loreum ipsium purpose
                This is a sample text just for loreum ipsium purpose
              </p>
              <button class="btn btn-outline-light">
                <router-link tag="a" to="/about" class="text-light">Read more...</router-link>
              </button>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email:""
    };
  },
  computed: {
    isComplete(){
      return this.email;
    }
  },
  methods: {
    sendMail(){
      alert();
    }
  }
};
</script>

<style lang="scss" scoped>
#forget {
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
  min-height: 522px;
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
