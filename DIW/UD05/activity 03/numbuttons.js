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
    @click="e => test(e)"
    >{{number}}</button>
    </div>
    `,
    methods:{
      test(e){
        console.log(e.target.innerHTML);
      }
    }
};
