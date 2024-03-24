<template>
  <Navbar />
</template>

<script>
  import Navigation from "./Navigation.vue";

  export default {
    name: "Articles",
    components: {
      Navbar: Navigation,
    },
  };
</script>
