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
    <form @submit.prevent="">
        <!-- email -->
        <label for="email">Email</label>
        <input
          v-model.trim="email"
          type="email"
          placeholder="Add your email"
        />
        <!-- password -->
        <label for="pass">Password</label>
        <input
          v-model.trim="password"
          type="password"
          placeholder="Add your password"
        />
        <!-- errors -->
        <div v-if="errors.length > 0" class="errors">
          <p v-for="error in errors" class="error">{{error}}</p>
        </div>
        <!-- buttons -->
        <button @click="loginUser">login</button>
    </form>
      `,
  watch: {
    "user.email": {
      handler(newEmail) {
        let regex =
          /[-0-9!#$%&'*+/=?^_`{|}~A-Za-z]+(?:\.[-0-9!#$%&'*+/=?^_`{|}~A-Za-z]+)*@(?:[0-9A-Za-z](?:[-0-9A-Za-z]*[0-9A-Za-z])?\.)+[0-9A-Za-z](?:[-0-9A-Za-z]*[0-9A-Za-z])?/i;
        let checkIsEmail = regex.test(newEmail);
        let checkEmpty = newEmail.length > 0;
        let correctEmail = checkIsEmail && checkEmpty;

        if (!correctEmail) this.addError("Your email is not correct");
        if (correctEmail) this.removeError("Your email is not correct");
      },
    },
    "user.password": {
      handler(newPassword) {
        let checkEmpty = newPassword.length > 0;

        if (!checkEmpty) this.addError("Password section is empty");
        if (checkEmpty) this.removeError("Password section is empty");
      },
    },
  },
  methods: {
    checkLoginForm(e) {
      let emailNotEmpty = e.target.form.email.value.trim().length > 0;
      let passNotEmpty = this.password.length > 0;
      let correctForm = emailNotEmpty && passNotEmpty;

      if (!correctForm) this.addError("There's 1 empty section at least.");

      if (correctForm) this.removeError("There's 1 empty section at least.");
    },
    checkEmailToLog(email) {
      this.users.some((e) => e.email === email)
        ? this.removeError("This email does not exists")
        : this.addError("This email does not exists");
    },
    checkPassToLog(email) {
      let pos = this.users.findIndex((e) => e.email === email);
      this.users[pos].password === this.password
        ? this.removeError("This password is incorrect")
        : this.addError("This password is incorrect");
    },
    loginUser(e) {
      this.checkLoginForm(e);

      this.checkLocalStorage();
      this.checkEmailToLog(this.user.email);
      this.checkPassToLog(this.user.email);

      let errors = this.errors.length > 0;

      if (!errors) {
        let pos = this.users.findIndex((e) => e.email === this.email);
        this.name = this.users[pos].name;
        e.target.form.reset();
        this.password = "";
        this.login = !this.login;
        this.logged = !this.logged;
      }
    },
  },
};
