import { createRouter, createMemoryHistory } from "vue-router";
import Articles from "./components/Articles.vue";
import Article from "./components/Article.vue";
import Home from "./components/Home.vue";

const routes = [
  { path: "/app", name: "home", component: Home },
  { path: "/app/articles", name: "articles", component: Articles },
  {
    path: "/app/articles/:guid",
    name: "article",
    props: true,
    component: Article,
  },
  { path: "/:catchAll(.*)", redirect: "/app" },
];

const router = createRouter({
  history: createMemoryHistory(),
  routes,
  linkActiveClass: "active",
  linkExactActiveClass: "exact-active",
});

export default router;
