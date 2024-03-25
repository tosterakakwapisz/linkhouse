<template>
  <div v-if="errorMsg">errorMsg</div>
  <div v-for="article in articles" class="card mt-3">
    <div class="card-body">
      <h5 class="card-title">
        {{ article.title }}
      </h5>
      <p class="card-text">
        {{ article.pubDate }}
      </p>
      <RouterLink
        :to="{ name: 'article', params: { guid: article.guid } }"
        class="btn btn-primary"
      >
        Details
      </RouterLink>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Articles",
    data() {
      return {
        articles: [],
        errorMsg: null,
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
            this.errorMsg = "There was an error getting articles";
          }
          const data = await response.json();
          this.articles = data;
          this.loading = false;
        } catch (error) {
          this.errorMsg = `There was an error getting articles. Error: ${error}`;
        }
      },
    },
  };
</script>
