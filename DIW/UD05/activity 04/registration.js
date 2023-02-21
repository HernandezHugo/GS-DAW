export default {
  props: {
    numbers: Array,
  },
  template: `
    <form @submit.prevent="">
    <!-- name -->
    <label for="name">Name</label>
    <input
      @change="e => checkName(e)"
      type="text"
      name="name"
      placeholder="Add your name"
    />
    <!-- email -->
    <label for="email">Email</label>
    <input
      @change="e => checkEmail(e)"
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
    <!-- re-password -->
    <label for="re-pass">Repeat your password</label>
    <input
      @change="e => comparePass(e)"
      type="password"
      name="re_pass"
    />
    <!-- errors -->
    <div v-if="errors.length > 0" class="errors">
      <p v-for="error in errors" class="error">{{error}}</p>
    </div>
    <!-- buttons -->
    <button  @click="e => registerUser(e)">Register</button>
  </form>
        `,
  methods: {
    sendData() {},
  },
};
