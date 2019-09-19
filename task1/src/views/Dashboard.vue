<template>
  <div class="col-md-10 shadow px-0" id="login">
    <div class="container-fluid px-0">
      <div
        class="d-flex justify-content-center align-items-center flex-md-row flex-sm-column flex-xs-column"
      >
        <section class="form-holder col-sm-12 col-md-12 py-5 order-lg-1 order-sm-2 order-xs-2">
          <div class="container">
            wlecome <br> <i class="fas fa-2x fa-user-circle"></i> <span class="clearfix d-none d-sm-inline-block">{{ fullname }}</span> <br>   <a class="dropdown-item" href="javascript:void(0);" @click="logOut">Log Out</a>
          </div>
         
        </section>
       
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';

export default {
  components: {
  },
  data() {
    return {
      
    };
  },
  computed: {
    ...mapState('auth', {
      fullname(state){
        if(!state.user) return '';
        const { name } = state.user;
        return name;
      }
    })
  },
  methods: {
    ...mapActions('sidebar', [
      'toggleSideCollapse'
    ]),
    logOut(){
      //dispatch action here
      this.$clearStorage();
      this.$store.dispatch('auth/logOut');
    }
  },
  mounted() {
  },
  updated() {
    
  },
  beforeDestroy() {
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
