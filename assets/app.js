/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";
import "bootstrap";

import { createApp } from "vue";
import Home from "./components/Home.vue";
import router from "./router";

createApp(Home).use(router).mount("#app");
