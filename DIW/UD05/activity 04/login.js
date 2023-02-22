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
