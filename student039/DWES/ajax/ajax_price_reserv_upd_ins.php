<script>
  function getPrice() {
    let URL = '../ajax/get_price_reserv_upd_ins.php';
    let category_selected = document.querySelector('#category_selected_upd_ins').value ?? '';
    let initial_date = document.querySelector('#initial_date_reserv_upd_ins').value ?? '';
    let final_date = document.querySelector('#final_date_reserv_upd_ins').value ?? '';
    let xhr = new XMLHttpRequest();

    xhr.open("GET", URL + '?q=' + category_selected + '&i=' + initial_date + '&f=' + final_date, true);

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200 && initial_date != '' && final_date != '' && category_selected != '') {
        printPrice(JSON.parse(this.responseText))
      }
    };

    xhr.send();
  }

  function printPrice(res) {

    let input_price = document.querySelector("#show_price_reserv_upd_ins");

    input_price.value = res;
  }
</script>