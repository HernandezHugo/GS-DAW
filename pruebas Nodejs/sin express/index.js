const http = require("http");
const fs = require("fs");

const hostname = "127.0.0.1";
const port = 3000;

const server = http.createServer((req, res) => {
  fs.readFile("./helloworld.html", (err, content) => {
    if (err) {
      res.statusCode = 500;
      res.end("Ocurrio un error interno del servidor");
    } else {
      res.statusCode = 200;
      res.setHeader("Content-Type", "text/html");
      res.end(content, "utf-8");
    }
  });
});

server.listen(port, hostname, () => {
  console.log(`Server running at http://${hostname}:${port}/`);
});
