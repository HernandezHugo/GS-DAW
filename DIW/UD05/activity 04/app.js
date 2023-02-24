import Router from "./router.js";
import navHeader from "./components/header.js";
import Products from "./components/products.js";

const { createApp } = Vue;

let app = createApp({
  data() {
    return {
      logged: false,
      user: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  components: {
    navHeader,
    Products,
  },
  
  methods: {
    
    setUserInfo(value) {
      this.user.name = value.name;
      this.user.email = value.email;
      this.user.password = value.password;
      this.logged = true;
      this.$router.push("/products");
    },
    logOut() {
      this.logged = false;
      this.user.name = "";
      this.user.email = "";
      this.user.password = "";
    },
  },
});
app.use(Router);
app.mount("#app");
