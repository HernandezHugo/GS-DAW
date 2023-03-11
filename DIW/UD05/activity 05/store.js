const store = Pinia.defineStore("store_users", {
  state: () => ({
    user: {
      name: "",
      email: "",
      password: "",
    },
    rePass: "",
    errors: [],
    users: [],
  }),
  getters: {
    name: (state) => state.user.name,
  },
  actions: {
    setName(name) {
      this.user.name = name;
    },
    setEmail(email) {
      this.user.email = email;
    },
    setPassword(password) {
      this.user.password = password;
    },
    setRePass(rePass) {
      this.rePass = rePass;
    },
    addError(error) {
      if (!this.errors.includes(error)) this.errors.push(error);
    },
    removeError(error) {
      let index = this.errors.indexOf(error);
      if (index !== -1) this.errors.splice(index, 1);
    },
    //login
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
    //register
    checkRegisterForm() {
      let nameNotEmpty = this.user.name.length > 0;
      let emailNotEmpty = this.user.email.length > 0;
      let passNotEmpty = this.user.password.length > 0;
      let correctForm = nameNotEmpty && emailNotEmpty && passNotEmpty;

      if (!correctForm) this.addError("There's 1 empty section at least.");

      if (correctForm) this.removeError("There's 1 empty section at least.");
    },
    checkNameToRegister(newName) {
      let checkNaN = isNaN(newName);
      let checkEmpty = newName.length > 0;
      let correctName = checkEmpty && checkNaN;

      console.log();
      if (!correctName) this.addError("Name section is not correct");
      if (correctName) {
        this.setName(newName);
        this.removeError("Name section is not correct");
      }
    },
    checkEmailToRegister(newEmail) {
      let regex =
        /[-0-9!#$%&'*+/=?^_`{|}~A-Za-z]+(?:\.[-0-9!#$%&'*+/=?^_`{|}~A-Za-z]+)*@(?:[0-9A-Za-z](?:[-0-9A-Za-z]*[0-9A-Za-z])?\.)+[0-9A-Za-z](?:[-0-9A-Za-z]*[0-9A-Za-z])?/i;
      let checkIsEmail = regex.test(newEmail);
      let checkEmpty = newEmail.length > 0;
      let correctEmail = checkIsEmail && checkEmpty;

      if (!correctEmail) this.addError("Your email is not correct");
      if (correctEmail) {
        this.setEmail(newEmail);
        this.removeError("Your email is not correct");
      }
    },
    checkPassToRegister(newPassword) {
      let checkEmpty = newPassword.length > 0;

      if (!checkEmpty) this.addError("Password section is empty");
      if (checkEmpty) {
        this.setPassword(newPassword);
        this.removeError("Password section is empty");
      }
    },

    checkRePass(newRePass) {
      let correctPass = this.user.password === newRePass;

      if (!correctPass) this.addError("Your password does not match.");
      if (correctPass) {
        this.setRePass(newRePass);
        this.removeError("Your password does not match.");
      }
    },
    checkLocalStorage() {
      if (localStorage.hasOwnProperty("users"))
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
        this.users.push(this.user);
        localStorage.setItem("users", JSON.stringify(this.users));

        localStorage.setItem("user_logged", JSON.stringify(this.user));

        this.$router.push("/products?q=true");
      }
    },
  },
});

export default store;
