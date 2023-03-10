<script>
  function getClients() {
    let URL = './ajax/get_clients.php';
    let hint = document.querySelector('#client_input').value
    let xhr = new XMLHttpRequest();

    xhr.open("GET", URL + '?q=' + hint, true);

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        printClients(JSON.parse(this.responseText))
      }
    };

    xhr.send();
  }

  function printClients(res) {

    let container = document.querySelector("#show_clients_container")
    container.innerHTML = '';

    let table = document.createElement("table")
    let tbody = document.createElement("tbody")
    let fragment_tr = document.createDocumentFragment()
    
    table.innerHTML = '<thead><tr><th scope="col">#</th><th scope="col">DNI</th><th scope="col">Firstname</th><th scope="col">Surname</th><th scope="col">Email</th><th scope="col">Phone number</th><th scope="col">Birthday</th><th scope="col">Actions</th></tr></thead>'
    
    
    res.forEach(client => {
      let fragment_td = document.createDocumentFragment()
      let tr = document.createElement("tr")
      let td_btn = document.createElement("td")

      Object.entries(client).forEach(client_data => {
        let td_data = document.createElement("td")
        td_data.innerText = client_data[1];
        fragment_td.appendChild(td_data)
      })

      let btn_update = document.createElement("a")
      let btn_delete = document.createElement("a")

      btn_update.classList.add("w-100", "m-1", "btn", "btn-outline-warning", "btn-sm")
      btn_update.setAttribute("href", "/student039/dwes/forms/form_clients_update.php?result=" + client["ID_client"])
      btn_update.innerText = 'Update'
      btn_delete.classList.add("w-100", "m-1", "btn", "btn-outline-danger", "btn-sm")
      btn_delete.setAttribute("href", "/student039/dwes/forms/form_clients_delete.php?result=" + client["ID_client"])
      btn_delete.innerText = 'Delete'

      td_btn.appendChild(btn_update);
      td_btn.appendChild(btn_delete);

      fragment_td.appendChild(td_btn);
      tr.appendChild(fragment_td)

      fragment_tr.appendChild(tr);
    });
    table.classList.add("table", "table-hover")
    table.appendChild(fragment_tr)
    container.appendChild(table)
  }
</script>