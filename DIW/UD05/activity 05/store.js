const store = Pinia.defineStore("store_users", {
  state: () => ({
    user: {
      name: "",
      email: "",
      password: "",
    },

    errors: [],
    users: [],
  }),
  actions: {
    addError(error) {
      if (!this.errors.includes(error)) this.errors.push(error);
    },
    removeError(error) {
      let index = this.errors.indexOf(error);
      if (index !== -1) this.errors.splice(index, 1);
    },
    
  },
});
