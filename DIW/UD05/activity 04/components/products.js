export default {
  data() {
    return {
      items: this.getData(),
    }
  },
  emits: ["setUserInfo"],
  methods: {
    setData(json) {
      this.items = json;
    },
    getData() {
      fetch("./data.json")
        .then((response) => response.json())
        .then((json) => this.setData(json));
    },
  },
  template: `
    <div v-for="item in items" class="container">
      <h3>{{ item.product }}</h3>
      <img v-bind:src="item.picture" />
      <p>{{ item.price }}€</p>
      <p>
        <span v-for="tag in item.tags">#{{ tag }}</span>
      </p>
    </div>`,
};
