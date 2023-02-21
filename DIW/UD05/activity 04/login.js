export default {
  data() {
    return {
      email: "",
      password: "",
      data: {},
      
    };
  },
  template: `
    <form @submit.prevent="">
        <!-- email -->
        <label for="email">Email</label>
        <input
          v-model.trim="email"
          type="email"
          name="email"
          placeholder="Add your email"
        />
        <!-- password -->
        <label for="pass">Password</label>
        <input
          v-model.trim="password"
          type="password"
          name="pass"
          placeholder="Add your password"
        />
        <button @click="loginUser">login</button>
    </form>
      `,
  methods: {
    loginUser() {
      this.data = {
        email: this.email,
        password: this.password,
      };
      this.$emit("setLoginInfo", this.data);
    },
  },
};
