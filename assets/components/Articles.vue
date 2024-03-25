<template>
  <input
    type="text"
    v-model="searchQuery"
    placeholder="Search by category or title"
    class="form-control mb-3"
    @input="filterArticles"
  />
  <div v-if="errorMsg">{{ errorMsg }}</div>
  <div v-for="article in filteredArticles" class="card mt-3">
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
        filteredArticles: [],
        errorMsg: null,
        searchQuery: "",
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
            throw new Error("There was an error getting articles");
          }
          const data = await response.json();
          this.articles = data;
          this.filteredArticles = data;
        } catch (error) {
          this.errorMsg = `There was an error getting articles. Error: ${error}`;
        }
      },
      filterArticles() {
        const query = this.searchQuery.toLowerCase();
        this.filteredArticles = this.articles.filter((article) => {
          return (
            article.title.toLowerCase().includes(query) ||
            article.category.toLowerCase().includes(query)
          );
        });
      },
    },
  };
</script>
