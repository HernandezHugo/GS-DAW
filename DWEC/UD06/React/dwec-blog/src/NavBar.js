const NavBar = () => {
  return (
    <nav className="navbar">
      <h1>El blog de DWEC</h1>
      <div className="links">
        <a href="/">Home</a>
        <a href="/crear" style={myStyle}>
          Nuevo Blog
        </a>
      </div>
    </nav>
  );
};

const myStyle = {
  color: "#fff",
  backgroundColor: "#f1356d",
  borderRadius: "5px",
};

export default NavBar;
