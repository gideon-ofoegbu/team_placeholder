<template>
  <div id="app">
    <component :is="layout">
      <!-- <router-view/> -->
    </component>
  </div>
</template>

<script>
  const default_layout = "auth";
  export default {
    computed: {
      layout() {
       //console.log((this.$route.meta.layout || default_layout) + "-layout");
        return (this.$route.meta.layout || default_layout) + "-layout";
      }
    },
    created() {
      // console.log(this.$route, this.$route.meta.layout);
    },
    updated() {
      // console.log(this.$route, this.$route.meta.layout);
    }
  };
</script>

<style lang="scss">
@import "./scss/_variables.scss";
@import "./scss/_mixins.scss";
@import "./scss/_functions.scss";


</style>
