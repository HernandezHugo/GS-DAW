export default {
  data() {
    return {
      login: false,
      register: false,
    };
  },
  props: {
    name: String,
    logged: Boolean,
  },
  template: `
    <nav>
        <div class="logo">
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
      handler(newURL) {
        if (newURL != undefined) this.login = newURL === "true";
      },
      immediate: true,
    },
  },
  methods: {
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
      this.$emit("logOut");
      this.$router.push("/");
    },
  },
};
