<template>
  <div
    class="auth-layout container-fluid d-flex justify-content-center align-items-center px-0"
  >
    <!-- <section class="col-md-6 light-side px-0"></section>
    <section class="col-md-6 dark-side px-0 d-none d-lg-block d-md-block d-sm-none d-xs-none">
      <div class="cover"></div>
    </section> -->
    <section class="formplaceholder d-flex justify-content-center align-items-center">
      <router-view/>
    </section>
  </div>
</template>

<script>
//export default {
//   components: {},
//   data() {
//     return {
//       height: window.innerHeight
//     };
//   }
// };
</script>

<style lang="scss" scoped>
.auth-layout {
  background: #f4f6f9;
  background: url(/img/background.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
      height: 100vh;
}
.light-side,
.dark-side {
  height: inherit;
}

.dark-side {
  background: #ff7700;
  position: relative;
}

.formplaceholder {
  position: relative;
  left: 0;
  right: 0;
  margin: auto;
}
</style>
