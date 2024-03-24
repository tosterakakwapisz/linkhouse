<template>
  <nav class="navbar navbar-expand-sm bg-body-tertiary">
    <div class="container">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item" v-for="item in menuItems" :key="item.path">
            <router-link :to="item.path" class="nav-link">
              {{ item.label }}
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
  export default {
    name: "Navigation",
    data() {
      return {
        menuItems: [
          { label: "Strona główna", path: "/app" },
          { label: "Artykuły", path: "/app/articles" },
        ],
      };
    },
  };
</script>

<style></style>
