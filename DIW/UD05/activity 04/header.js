export default {
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
          <p v-if="logged" id="welcome">Hello, {{ name }}</p>
          <a v-if="!logged" @click="toggleLogin()">Login</a>
          <a v-if="!logged" @click="toggleRegister()">Register</a>
          <a v-if="logged" @click="logOut()">Log Out</a>
        </div>
    </nav>
        `,
  methods: {
    frontPage() {
      this.$emit("frontPage");
    },
    toggleLogin() {
      this.$emit("toggleLogin");
    },
  },
};
