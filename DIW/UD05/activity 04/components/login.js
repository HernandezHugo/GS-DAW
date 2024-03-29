export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
      },
      errors: [],
      users: [],
    };
  },
  template: `
    <form>
        <!-- email -->
        <label for="email">Email</label>
        <input
          v-model.trim="user.email"
          type="email"
          placeholder="Add your email"
        />
        <!-- password -->
        <label for="pass">Password</label>
        <input
          v-model.trim="user.password"
          type="password"
          placeholder="Add your password"
        />
        <!-- errors -->
        <div v-if="errors.length > 0" class="errors">
          <p v-for="error in errors" class="error">{{error}}</p>
        </div>
        <!-- buttons -->
        <button @click.prevent="loginUser">login</button>
    </form>
      `,
  methods: {
    addError(error) {
      if (!this.errors.includes(error)) this.errors.push(error);
    },
    removeError(error) {
      let index = this.errors.indexOf(error);
      if (index !== -1) this.errors.splice(index, 1);
    },
    checkLoginForm() {
      let emailNotEmpty = this.user.email.length > 0;
      let passNotEmpty = this.user.password.length > 0;
      let correctForm = emailNotEmpty && passNotEmpty;

      if (correctForm) {
        this.removeError("There's 1 empty section at least.");
        return true;
      } else {
        this.addError("There's 1 empty section at least.");
        return false;
      }
    },
    checkEmailToLog() {
      if (this.users.some((e) => e.email === this.user.email)) {
        this.removeError("This email does not exists");
        return true;
      } else {
        this.addError("This email does not exists");
        return false;
      }
    },
    checkPassToLog() {
      let pos = this.users.findIndex((e) => e.email === this.user.email);
      this.users[pos].password === this.user.password
        ? this.removeError("This password is incorrect")
        : this.addError("This password is incorrect");
    },
    checkLocalStorage() {
      if (localStorage.hasOwnProperty("users"))
        this.users = JSON.parse(localStorage.getItem("users"));
    },
    loginUser() {
      this.checkLocalStorage();

      if (this.checkLoginForm())
        if (this.checkEmailToLog(this.user.email))
          this.checkPassToLog(this.user.email);

      let errors = this.errors.length > 0;

      if (!errors) {
        let pos = this.users.findIndex((e) => e.email === this.user.email);
        this.user.name = this.users[pos].name;

        localStorage.setItem("user_logged", JSON.stringify(this.user));

        this.$router.push("/products?q=true");
      }
    },
  },
};
