import { createRouter, createMemoryHistory } from "vue-router";
import Articles from "./components/Articles.vue";
import Home from "./components/Home.vue";

const routes = [
  { path: "/app", component: Home },
  { path: "/app/articles", component: Articles },
  { path: "/:catchAll(.*)", redirect: "/app" },
];

const router = createRouter({
  history: createMemoryHistory(),
  routes,
  linkActiveClass: "active",
  linkExactActiveClass: "exact-active",
});

export default router;
