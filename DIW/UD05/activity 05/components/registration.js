import store from "../store.js";
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
    <form>
      <!-- name -->
      <label for="name">Name</label>
      <input
        v-model.trim="user.name"
        @input="checkNameToRegister(user.name)"
        type="text"
        placeholder="Add your name"
      />
      <!-- email -->
      <label for="email">Email</label>
      <input
        v-model.trim="user.email"
        @input="checkEmailToRegister(user.email)"
        type="email"
        placeholder="Add your email"
      />
      <!-- password -->
      <label for="pass">Password</label>
      <input
        v-model.trim="user.password"
        @input="checkPassToRegister(user.password)"
        type="password"
        placeholder="Add your password"
      />
      <!-- re-password -->
      <label for="re-pass">Repeat your password</label>
      <input
        v-model.trim="rePass"
        @input="checkRePass(rePass)"
        type="password"
        placeholder="Add your password again"
      />
      <!-- errors -->
        <p v-for="error in errors" class="error">{{error}}</p>
      <!-- buttons -->
      <button  @click.prevent="registerUser">Register</button>
    </form>
        `,
  computed: {
    ...Pinia.mapState(store, ["errors"]),
  },
  methods: {
    ...Pinia.mapActions(store, ["registerUser"]),
    ...Pinia.mapActions(store, ["checkNameToRegister"]),
    ...Pinia.mapActions(store, ["checkEmailToRegister"]),
    ...Pinia.mapActions(store, ["checkPassToRegister"]),
    ...Pinia.mapActions(store, ["checkRePass"]),
    
    
  },
};
