export default {
  props: {
    email: String,
    password: String,
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
        <button @click="e => loginUser(e)">login</button>
    </form>
      `,
  methods: {
    sendData() {
    },
  },
};
