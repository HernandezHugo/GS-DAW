const Home = () => {
  const chars = ["A", "B"];
  let count = [];

  const handleClick = (x) => {
    let random = Math.random() * 5;
    console.log(random + " asdfasdf: " + x);
  };
  const idkClick = () => {
    console.log("idk");
  };

  const getRandomChar = () => {
    let j = 0;
    for (let i = 0; i < chars.length; j++) {
      let pos = Math.floor(Math.random() * chars.length);
      console.log(chars[pos]);
      console.log(pos + ": " + count[j] + " - " + j);
      
      count.push(chars[pos]);
      
    }
  };

  return (
    <div className="Home">
      <h1>App Component: Home</h1>
      <button
        onClick={() => {
          let x = prompt("111");
          handleClick(x);
        }}
      >
        Go!
      </button>
      <button onClick={idkClick}>IDK!</button>
      <button onClick={getRandomChar}>RandomChar</button>
    </div>
  );
};

export default Home;
