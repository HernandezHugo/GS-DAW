export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
      },
      rePass: "",
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
      />
      <!-- errors -->
      <div v-if="errors.length > 0" class="errors">
        <p v-for="error in errors" class="error">{{error}}</p>
      </div>
      <!-- buttons -->
      <button  @click="registerUser">Register</button>
    </form>
        `,
  methods: {
    registerUser() {},
  },
};
