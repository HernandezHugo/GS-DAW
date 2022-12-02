// This works on all devices/browsers, and uses IndexedDBShim as a final fallback
let indexedDB =
  window.indexedDB ||
  window.mozIndexedDB ||
  window.webkitIndexedDB ||
  window.msIndexedDB ||
  window.shimIndexedDB;
const DB_STORE_NAME = "users";
const DB_VERSION = 1;

function logerr(err) {
  console.log('An error occurred with IndexedDB');
  console.log(err);
}

function connectDB(f) {
  // Open (or create) the database
  let request = indexedDB.open(DB_STORE_NAME, DB_VERSION);
  request.onerror = logerr;
}
