import Router from "./router.js";
import navHeader from "./components/header.js";
import Products from "./components/products.js";

const { createApp } = Vue;

let app = createApp({
  components: {
    navHeader,
    Products,
  },
});
app.use(Router);
app.mount("#app");
