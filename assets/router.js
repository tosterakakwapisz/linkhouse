import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import Articles from "./components/Articles.vue";

const routes = [
  { path: "/app", component: Home },
  { path: "/app/articles", component: Articles },
  { path: "/app/articles", component: Articles },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  linkActiveClass: "active",
  linkExactActiveClass: "exact-active",
});

export default router;
