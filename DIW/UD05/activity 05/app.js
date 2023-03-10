import Router from "./router.js";
import store from "./store.js";
import navHeader from "./components/header.js";
import Products from "./components/products.js";

const { createApp } = Vue;

const pinia = Pinia.createPinia();

let app = createApp({
  components: {
    navHeader,
    Products,
  },
});

app.use(pinia);
app.use(Router);
app.mount("#app");
