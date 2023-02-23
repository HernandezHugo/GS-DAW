import Router from "./router.js";
import navHeader from "./components/header.js";
import Products from "./components/products.js";

const { createApp } = Vue;

let app = createApp({
  data() {
    return {
      logged: false,
      login: false,
      register: false,
      user: {
        name: "",
        email: "",
        password: "",
      },
      rePass: "",
      
    };
  },
  components: {
    navHeader,
    Products,
  },
  methods: {
    frontPage() {
      this.login = false;
      this.register = false;
    },
    setUserInfo(value) {
      this.user.name = value.name;
      this.user.email = value.email;
      this.user.password = value.password;
      this.logged = true;
      this.$router.push("/products");
    },
    toggleRegister() {
      this.register = !this.register;
      this.login ? (this.login = !this.login) : this.login;
    },
    toggleLogin() {
      this.login = !this.login;
      this.register ? (this.register = !this.register) : this.register;
    },
    logOut() {
      this.logged = false;
      this.user.name = "";
      this.user.email = "";
      this.user.password = "";
      this.frontPage();
    },
  },
});
app.use(Router);
app.mount("#app");
