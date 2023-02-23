import navHeader from "./components/header.js";
import Login from "./components/login.js";
import Registration from "./components/registration.js";
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
      items: this.getData(),
    };
  },
  components: {
    navHeader,
    Login,
    Registration,
    Products,
  },
  methods: {
    setData(json) {
      this.items = json;
    },
    getData() {
      fetch("./data.json")
        .then((response) => response.json())
        .then((json) => this.setData(json));
    },
    frontPage() {
      this.login = false;
      this.register = false;
    },
    setUserInfo(value) {
      this.user.name = value.name;
      this.user.email = value.email;
      this.user.password = value.password;

      this.logged = true;
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
}).mount("#app");
