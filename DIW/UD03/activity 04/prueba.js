const indexedDB = window.indexedDB;
const form = document.getElementById("form");
const lista = document.getElementById("lista");

if (indexedDB) {
  let db;

  //INITIALIZE DB
  const req = indexedDB.open("usersDB", 1);

  req.onsuccess = () => {
    db = req.result;
    console.log("OPEN", db);
    readData();
  };

  req.onupgradeneeded = () => {
    db = req.result;
    console.log("CREATED", db);

    const objectStore = db.createObjectStore("users", {
      keypath: "id_user",
      autoIncrement: true,
    });
    objectStore.createIndex("users_name", ["name"], { unique: false });
    objectStore.createIndex("users_email", ["email"], { unique: false });
  };

  req.onerror = (error) => {
    console.log("Error", error);
  };

  //CREATE USER
  const addData = (data) => {
    const transaction = db.transaction(["users"], "readwrite");
    const objectStore = transaction.objectStore("users");
    const req = objectStore.add(data);
    readData();
  };

  const getData = (key) => {
    const transaction = db.transaction(["users"], "readwrite");
    const objectStore = transaction.objectStore("users");
    const req = objectStore.get(key);

    req.onsuccess = () => {
      form.name.value = req.result.name;
      form.email.value = req.result.email;
      form.button.value = "Update";
      form.button.dataset.action = "update";
      form.button.dataset.key = key;
      readData();
    };
  };

  //UPDATE USER
  const updateData = (data, key) => {
    const transaction = db.transaction(["users"], "readwrite");
    const objectStore = transaction.objectStore("users");
    const req = objectStore.put(data, key);
    req.onsuccess = () => {
      form.button.value = "Add";
      form.button.dataset.action = "add";
      form.button.dataset.key = "";
      readData();
    };
  };

  //DELETE USER
  const deleteData = (key) => {
    const transaction = db.transaction(["users"], "readwrite");
    const objectStore = transaction.objectStore("users");
    const req = objectStore.delete(key);
    req.onsuccess = () => {
      readData();
    };
  };

  //READ USERS
  const readData = () => {
    const transaction = db.transaction(["users"], "readonly");
    const objectStore = transaction.objectStore("users");
    const req = objectStore.openCursor();
    const fragment = document.createDocumentFragment();

    req.onsuccess = (e) => {
      const cursor = e.target.result;
      if (cursor) {
        const userName = document.createElement("p");
        userName.textContent = cursor.value.name;
        fragment.appendChild(userName);

        const userEmail = document.createElement("p");
        userEmail.textContent = cursor.value.email;
        fragment.appendChild(userEmail);

        const userUpdate = document.createElement("button");
        userUpdate.dataset.type = "update";
        userUpdate.dataset.key = cursor.key;
        userUpdate.textContent = "Update";
        fragment.appendChild(userUpdate);

        const userDelete = document.createElement("button");
        userDelete.dataset.type = "delete";
        userDelete.dataset.key = cursor.key;
        userDelete.textContent = "Delete";
        fragment.appendChild(userDelete);

        cursor.continue();
      } else {
        lista.innerHTML = "";
        lista.appendChild(fragment);
      }
    };
  };

  //EVENTS
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const data = {
      name: e.target.name.value,
      email: e.target.email.value,
      password: md5(e.target.password.value),// HASH md5
    };
    if (e.target.button.dataset.action == "add") {
      addData(data);
    } else if (e.target.button.dataset.action == "update") {
      updateData(data, +e.target.button.dataset.key);
    }
    form.reset();
  });

  lista.addEventListener("click", (e) => {
    if (e.target.dataset.type == "update") {
      getData(+e.target.dataset.key);
    } else if (e.target.dataset.type == "delete") {
      deleteData(+e.target.dataset.key);
    }
  });
}
