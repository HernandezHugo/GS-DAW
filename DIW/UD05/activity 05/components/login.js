import store from "../store.js";

export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  template: `
    <form>
        <!-- email -->
        <label for="email">Email</label>
        <input
          v-model.trim="user.email"
          @change="setEmail(user.email)"
          type="email"
          placeholder="Add your email"
        />
        <!-- password -->
        <label for="pass">Password</label>
        <input
          v-model.trim="user.password"
          @change="setPassword(user.password)"
          type="password"
          placeholder="Add your password"
        />
        <!-- errors -->
        
          <p v-for="error in errors" class="error">{{error}}</p>
        
        <!-- buttons -->
        <button @click.prevent="loginUser">login</button>
    </form>
      `,
  computed: {
    ...Pinia.mapState(store, ["errors"]),
  },
  methods: {
    ...Pinia.mapActions(store, ["loginUser"]),
    ...Pinia.mapActions(store, ["setEmail"]),
    ...Pinia.mapActions(store, ["setPassword"]),
  },
};
