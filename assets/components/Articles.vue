<template>
  <div>
    <Navbar :navItems="navItems" activeRoute="/articles" />
  </div>
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
