import store from "../store.js";

export default {
  data() {
    return {
      logged: false,
      login: false,
      register: false,
    };
  },
  template: `
    <nav>
        <div @click="goToProducts" class="logo">
          <img src="./img/fedora-guy.png" />
          <h1>Fedora</h1>
        </div>
        <div class="tags">
          <p v-if="logged" id="welcome">Hello, {{ name }}</p>
          <a v-if="!login && !logged" @click="goToLogin()">Login</a>
          <a v-if="!register && !logged" @click="goToRegister()">Register</a>
          <a v-if="logged" @click="logOut()">Log Out</a>
        </div>
    </nav>
        `,
  watch: {
    "$route.query.q": {
      handler(newValue) {
        newValue === "true" && newValue != undefined && this.checkUserLogged()
          ? (this.logged = newValue === "true")
          : this.logged;
      },
      immediate: true,
    },
    logged: {
      handler() {
        if (this.checkUserLogged()) {
          this.logged = true;
          this.goToProducts();
        } else {
          this.logged = false;
          this.goToLogin();
        }
      },
      immediate: true,
    },
  },
  computed: {
    ...Pinia.mapState(store, ["name"]),
  },
  methods: {
    checkUserLogged() {
      if (localStorage.hasOwnProperty("user_logged")) {
        this.user = JSON.parse(localStorage.getItem("user_logged"));
        return true;
      } else return false;
    },
    goToProducts() {
      this.login = false;
      this.register = false;
      this.$router.push("/products");
    },
    goToLogin() {
      this.login = !this.login;
      this.register ? (this.register = !this.register) : this.register;
      this.$router.push("/login");
    },
    goToRegister() {
      this.register = !this.register;
      this.login ? (this.login = !this.login) : this.login;
      this.$router.push("/registration");
    },
    logOut() {
      this.user.name = "";
      this.user.email = "";
      this.user.password = "";

      localStorage.removeItem("user_logged");

      this.logged = false;
      this.$router.push("/");
    },
  },
};
