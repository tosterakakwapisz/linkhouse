<template>
  <div v-if="loading">Loading...</div>
  <div v-else>
    <div v-for="article in articles" :key="article.id">
      {{ article.title }}
    </div>
  </div>
</template>

<script>
  export default {
    name: "Articles",
    data() {
      return {
        articles: [],
        loading: true,
      };
    },
    mounted() {
      this.fetchArticles();
    },
    methods: {
      async fetchArticles() {
        try {
          const response = await fetch("/articles");
          if (!response.ok) {
            throw new Error("Failed to fetch articles");
          }
          const data = await response.json();
          this.articles = data;
          this.loading = false;
        } catch (error) {
          console.error("Error fetching articles:", error);
        }
      },
    },
  };
</script>
