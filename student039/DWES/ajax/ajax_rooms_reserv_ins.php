<script>
  function getRooms() {
    let URL = '../ajax/get_rooms_reserv_ins.php';
    let hint = document.querySelector('#category_selected_ins').value ?? '';
    let xhr = new XMLHttpRequest();

    xhr.open("GET", URL + '?q=' + hint, true);

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200 && hint != '') {
        printRooms(JSON.parse(this.responseText))
      }
    };

    xhr.send();
  }

  function printRooms(res) {

    let container = document.querySelector("#show_rooms_reserv_ins");
    container.innerHTML = '';

    let fragment = document.createDocumentFragment()

    res.forEach(room => {
      let option = document.createElement("option")
      option.value = room['ID_room'];
      option.innerText = room['ID_room'];

      fragment.appendChild(option)
    });

    container.appendChild(fragment)
  }
</script>