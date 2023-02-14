import numbuttons from "./numbuttons.js";

const { createApp } = Vue;

let app = createApp({
  data() {
    return {
      list: false,
      wronginput: false,
      error: "",
      numbers: [],
    };
  },
  methods: {
    addNumber(value) {
      if (!this.list) this.list = !this.list;
      this.numbers.push(value);
    },
    control(e) {
      let value = e.target.form.num.value;
      e.target.form.reset();
      this.wronginput = false;
      this.error = "";

      if (isNaN(value)) this.printError("Is not a number");
      if (value.length == 0) this.printError("Put a number");
      if (value.includes(".") || value.includes(","))
        this.printError("Is not an integer");
      if (this.numbers.includes(value))
        this.printError("This number already exists");
      if (this.wronginput == false) this.addNumber(value);
    },
    printError(error) {
      this.wronginput = true;
      this.error = error;
    },
  },
  components: {
    numbuttons,
  },
});

app.mount("#app");

/*input number
only integers -chars,-decimals
-repeat numbers
control errors

List of numbers:
buttons ==> indicate which numbers is pressed
*/
