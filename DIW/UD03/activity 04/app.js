// This works on all devices/browsers, and uses IndexedDBShim as a final fallback
let indexedDB =
  window.indexedDB ||
  window.mozIndexedDB ||
  window.webkitIndexedDB ||
  window.msIndexedDB ||
  window.shimIndexedDB;
const DB_NAME = "usersDB";
const DB_STORE_NAME = "users";
const DB_VERSION = 1;
let db;

function createUser(db) {
  const user_name = document.querySelector("input[name='name']");
  const user_email = document.querySelector("input[name='email']");
  const user_password = document.querySelector("input[name='password']");
  const obj = {
    name: user_name.value,
    email: user_email.value,
    password: user_password.value,
  };

  console.log(obj);
  const transaction = db.transaction(DB_STORE_NAME, "readwrite");

  const store = transaction.objectStore(DB_STORE_NAME);

  store.put(obj);

  transaction.oncomplete = function () {
    db.close();
  };
}

function connectDB() {
  // Open (or create) the database
  let request = indexedDB.open(DB_NAME, DB_VERSION);

  request.onerror = function (err) {
    console.log("An error occurred with IndexedDB");
    console.log(err);
  };

  request.onupgradeneeded = function () {
    const db = request.result;
    const store = db.createObjectStore(DB_STORE_NAME, {
      keypath: "id_user",
      autoIncrement: true,
    });
    store.createIndex("users_name", ["name"], { unique: false });
    store.createIndex("users_email", ["email"], { unique: false });
    //store.createIndex("name_and_email", ["name", "email"], { unique: false }); //compound index
  };
  request.onsuccess = function () {
    const db = request.result;
    createUser(db);
  };

  /* request.onsuccess = function () {
    const db = request.result;
    const transaction = db.transaction(DB_STORE_NAME, "readwrite");

    const store = transaction.objectStore(DB_STORE_NAME);

    const nameIndex = store.index("users_name");
    const emailIndex = store.index("users_email");

    store.put({ name: "toni", email: "correo@correo.com", password: 123 });
    store.put({ name: "tony", email: "correo1@correo.com", password: 123 });
    store.put({ name: "tommy", email: "corre2o@correo.com", password: 123 });

    const idQuery = store.getAll();
    const nameQuery = nameIndex.get(["toni"]);
    const emailQuery = emailIndex.getAll(["correo@correo.com"]);

    idQuery.onsuccess = function () {
      console.log("idQuery", idQuery.result);
    };
    nameQuery.onsuccess = function () {
      console.log("nameQuery", nameQuery.result);
    };
    emailQuery.onsuccess = function () {
      console.log("emailQuery", emailQuery.result);
    };

    transaction.oncomplete = function () {
      db.close();
    };
  }; */
}
/* 
connectDB(); */

document
  .querySelector("form")
  .addEventListener("submit", connectDB(), false);

