export default {
  props: {
    item: Object,
  },
  template: `
  <div class="container">
  <h3>{{ item.product }}</h3>
  <img v-bind:src="item.picture" />
  <p>{{ item.price }}€</p>
  <p>
    <span v-for="tag in item.tags">#{{ tag }}</span>
  </p>
  </div>`,
};
