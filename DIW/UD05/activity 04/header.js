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
        <div @click="frontPage()" class="logo">
          <img src="./img/fedora-guy.png" />
          <h1>Fedora</h1>
        </div>
        <div class="tags">
          <p v-show="logged" id="welcome">Hello, {{ name }}</p>
          <a v-show="!logged" @click="toggleLogin()">Login</a>
          <a v-show="!logged" @click="toggleRegister()">Register</a>
          <a v-show="logged" @click="logOut()">Log Out</a>
        </div>
    </nav>
        `,
  methods: {
    frontPage() {
      this.login = false;
      this.register = false;
    },
    toggleRegister() {
      this.register = !this.register;
      this.errors = [];
      this.login ? (this.login = !this.login) : this.login;
    },
    toggleLogin() {
      this.login = !this.login;
      this.errors = [];
      this.register ? (this.register = !this.register) : this.register;
    },
  },
};
