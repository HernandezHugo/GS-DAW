import "./App.css";
import NavBar from "./NavBar";
import Home from "./Home";

function App() {
  /* const titulo = "Bienvenidos al blog de DWEC";
  const contador = 1234;
  const link = "https://www.google.com";
  const persona = {
    nombre : "ert",
    apellido : "ujuju"
  } */

  /* const links = [
    "https://www.google.com",
    "https://www.fcbarcelona.cat",
    "https://www.iesjoanramis.org",
  ]; */
  return (
    <div className="App">
        <NavBar></NavBar>
      <div className="contenido">
        {/* <h1>{ titulo }</h1>
        <p>{ "asd" }</p>
        <p>{ "asd" + contador }</p>
        <p>{ persona.nombre + " " + persona.apellido}</p>
        <p>{ [1,2,3,4] }</p>
        <a href={ link }>Google</a> */}

        <Home></Home>
      </div>

      {/* <ul>
        {links.map((value, index) => {
          return (
            <li key={index}>
              {index + 1} - <a href={links[index]}>{links[index]}</a>
            </li>
          );
        })}
      </ul> */}
    </div>
  );
}

export default App;
