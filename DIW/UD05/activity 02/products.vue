<script>
export default {
  data() {
    return {
      items: this.getData(),
    };
  },
};
</script>

<template>
  <h3>{{ item.product }}</h3>
  <img v-bind:src="item.picture" />
  <p>{{ item.price }}€</p>
  <p>
    <span v-for="tag in item.tags">#{{ tag }}</span>
  </p>
</template>
