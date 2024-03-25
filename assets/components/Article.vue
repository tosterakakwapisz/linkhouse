<template>
  <h3 class="mb-3">
    <RouterLink :to="{ name: 'articles' }">Back to articles</RouterLink>
  </h3>
  <div v-if="errorMsg">{{ errorMsg }}</div>
  <div v-else class="card" :data-guid="details.guid">
    <div class="card-body">
      <h5 class="card-title mb-0">{{ details.title }}</h5>
      <h6 class="card-subtitle my-3 text-body-secondary">
        {{ details.category }}
      </h6>
      <p v-html="details.description" class="card-text"></p>
      <a :href="details.link" target="_blank" class="card-link">
        Read full article
      </a>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Article",
    props: {
      guid: String,
    },
    data() {
      return {
        details: {},
        errorMsg: null,
      };
    },
    mounted() {
      this.fetchDetails();
    },
    methods: {
      extractGuid(fullGuid) {
        let regex = /\?p=(\d+)/;
        let matches = fullGuid.match(regex);
        return matches[1];
      },
      async fetchDetails() {
        let guid = this.extractGuid(this.guid);
        let response = await fetch(`/article/${guid}`);
        let responseData = await response.json();
        if (!response.ok) {
          this.errorMsg = `Could not get article with GUID: ${guid}. Error: ${responseData.message}`;
        }

        this.details = responseData;
      },
    },
  };
</script>
