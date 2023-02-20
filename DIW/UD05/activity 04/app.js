import Products from "./products.js";
import Login from "./login.js";
import Registration from "./registration.js";
import navHeader from "./header.js";

const { createApp } = Vue;

let app = createApp({
  data() {
    return {
      logged: false,
      login: false,
      register: false,
      name: "",
      email: "",
      password: "",
      errors: [],
      users: [],
      items: this.getData(),
      notShow: false,
    };
  },
  components: {
    Products,
    Login,
    Registration,
    navHeader,
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
    registerUser(e) {
      this.checkRegisterForm(e);
      this.checkLocalStorage();
      this.checkIEmailToReg(e.target.form.email.value);

      let errors = this.errors.length > 0;

      if (!errors) {
        const dataUser = {
          name: e.target.form.name.value,
          email: e.target.form.email.value,
          password: this.password,
        };

        this.users.push(dataUser);
        localStorage.setItem("users", JSON.stringify(this.users));

        e.target.form.reset();
        this.register = !this.register;
      }
      this.password = "";
      e.target.form.re_pass.value = "";
    },
    checkRegisterForm(e) {
      let nameNotEmpty = e.target.form.name.value.trim().length > 0;
      let emailNotEmpty = e.target.form.email.value.trim().length > 0;
      let passNotEmpty = this.password.length > 0;
      let correctForm = nameNotEmpty && emailNotEmpty && passNotEmpty;

      if (!correctForm) this.addError("There's 1 empty section at least.");

      if (correctForm) this.removeError("There's 1 empty section at least.");
    },
    loginInfo(args) {
      console.log(args);
    },
    loginUser(e) {
      this.checkLoginForm(e);
      this.checkLocalStorage();
      this.checkEmailToLog(this.email);
      this.checkPassToLog(this.email);

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
    checkLoginForm(e) {
      let emailNotEmpty = e.target.form.email.value.trim().length > 0;
      let passNotEmpty = this.password.length > 0;
      let correctForm = emailNotEmpty && passNotEmpty;

      if (!correctForm) this.addError("There's 1 empty section at least.");

      if (correctForm) this.removeError("There's 1 empty section at least.");
    },

    checkLocalStorage() {
      if (localStorage.length != 0)
        this.users = JSON.parse(localStorage.getItem("users"));
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
    checkIEmailToReg(email) {
      this.users.some((e) => e.email === email)
        ? this.addError("This email already exists")
        : this.removeError("This email already exists");
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
    checkName(e) {
      let checkNaN = isNaN(e.target.value.trim());
      let checkEmpty = e.target.value.trim().length > 0;
      let correctName = checkEmpty && checkNaN;
      if (!correctName) {
        this.addDangerStyle(e.target);
        this.addError("Name section is empty");
      }
      if (correctName) {
        this.removeDangerStyle(e.target);
        this.removeError("Name section is empty");
      }
    },
    checkEmail(e) {
      let regex =
        /[-0-9!#$%&'*+/=?^_`{|}~A-Za-z]+(?:\.[-0-9!#$%&'*+/=?^_`{|}~A-Za-z]+)*@(?:[0-9A-Za-z](?:[-0-9A-Za-z]*[0-9A-Za-z])?\.)+[0-9A-Za-z](?:[-0-9A-Za-z]*[0-9A-Za-z])?/i;
      let checkIsEmail = regex.test(e.target.value.trim());
      let checkEmpty = e.target.value.trim().length > 0;
      let correctEmail = checkIsEmail && checkEmpty;
      if (!correctEmail) {
        this.addDangerStyle(e.target);
        this.addError("Your email is not correct");
      }
      if (correctEmail) {
        this.removeDangerStyle(e.target);
        this.removeError("Your email is not correct");
      }
    },
    comparePass(e) {
      let correctPass = e.target.form.pass.value === e.target.value;
      if (!correctPass) {
        this.addDangerStyle(e.target);
        this.addError("Your password does no match.");
      }
      if (correctPass) {
        this.removeDangerStyle(e.target);
        this.removeError("Your password does no match.");
      }
    },
    addError(error) {
      if (!this.errors.includes(error)) this.errors.push(error);
    },
    removeError(error) {
      let index = this.errors.indexOf(error);
      if (index !== -1) this.errors.splice(index, 1);
    },
    addDangerStyle(target) {
      let dangerExists = target.classList.length > 0;
      if (!dangerExists) target.classList.toggle("danger");
    },
    removeDangerStyle(target) {
      let dangerExists = target.classList.length > 0;
      if (dangerExists) target.classList.toggle("danger");
    },
    logOut() {
      this.logged = !this.logged;
      this.name = "";
      this.email = "";
      this.password = "";
    },
  },
}).mount("#app");
