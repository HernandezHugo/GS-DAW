export default {
  props: {
    numbers: Array,
  },
  template: `
    <div class="container">
    <h3>List of numbers:</h3>
    <button 
    v-for="number in numbers" 
    class="btn"
    @click="e => sendData(e)"
    >{{number}}</button>
    </div>
    `,
    methods:{
      sendData(e){
        this.$emit("sending-data", +e.target.innerHTML)
      }
    }
};
