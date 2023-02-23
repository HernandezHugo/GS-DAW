export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
      },
      rePass: "",
      errors: [],
      users: [],
    };
  },
  template: `
    <form @submit.prevent="">
      <!-- name -->
      <label for="name">Name</label>
      <input
        v-model.trim="user.name"
        type="text"
        placeholder="Add your name"
      />
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
      <!-- re-password -->
      <label for="re-pass">Repeat your password</label>
      <input
        v-model.trim="rePass"
        type="password"
        placeholder="Add your password again"
      />
      <!-- errors -->
      <div v-if="errors.length > 0" class="errors">
        <p v-for="error in errors" class="error">{{error}}</p>
      </div>
      <!-- buttons -->
      <button  @click="registerUser">Register</button>
    </form>
        `,
  watch: {
    "user.name": {
      handler(newName) {
        let checkNaN = isNaN(newName);
        let checkEmpty = newName.length > 0;
        let correctName = checkEmpty && checkNaN;

        if (!correctName) this.addError("Name section is empty");
        if (correctName) this.removeError("Name section is empty");
      },
    },
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
    rePass: {
      handler(newRePassword) {
        let correctPass = this.user.password === newRePassword;

        if (!correctPass) this.addError("Your password does not match.");
        if (correctPass) this.removeError("Your password does not match.");
      },
    },
  },
  methods: {
    async addError(error) {
      if (!this.errors.includes(error)) this.errors.push(error);
    },
    async removeError(error) {
      let index = this.errors.indexOf(error);
      if (index !== -1) this.errors.splice(index, 1);
    },
    checkRegisterForm() {
      let nameNotEmpty = this.user.name.length > 0;
      let emailNotEmpty = this.user.email.length > 0;
      let passNotEmpty = this.user.password.length > 0;
      let correctForm = nameNotEmpty && emailNotEmpty && passNotEmpty;

      if (!correctForm) this.addError("There's 1 empty section at least.");

      if (correctForm) this.removeError("There's 1 empty section at least.");
    },
    checkLocalStorage() {
      if (localStorage.length != 0)
        this.users = JSON.parse(localStorage.getItem("users"));
    },
    checkEmailToReg() {
      this.users.some((e) => e.email === this.user.email)
        ? this.addError("This email already exists")
        : this.removeError("This email already exists");
    },
    registerUser() {
      this.checkLocalStorage();
      this.checkEmailToReg();
      this.checkRegisterForm();

      let errors = this.errors.length > 0;
      if (!errors) {
        const dataUser = {
          name: this.user.name,
          email: this.user.email,
          password: this.user.password,
        };

        this.users.push(dataUser);
        localStorage.setItem("users", JSON.stringify(this.users));

        this.$emit('setUserInfo', this.user)
      }
    },
  },
};
