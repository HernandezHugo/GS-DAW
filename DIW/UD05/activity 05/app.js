import router from "./router.js";
import navHeader from "./components/header.js";
import Products from "./components/products.js";

const { createApp, markRaw } = Vue;

const pinia = Pinia.createPinia();

pinia.use(({ store }) => {
  store.$router = markRaw(router);
});

let app = createApp({
  components: {
    navHeader,
    Products,
  },
});

app.use(pinia);
app.use(router);
app.mount("#app");
