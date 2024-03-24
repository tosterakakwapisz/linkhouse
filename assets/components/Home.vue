<template>
  <Navbar />
</template>

<script>
  import Navigation from "./Navigation.vue";

  export default {
    name: "Home",
    components: {
      Navbar: Navigation,
    },
  };
</script>
