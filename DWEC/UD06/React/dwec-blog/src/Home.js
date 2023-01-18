import { useState } from "react";

const Home = () => {
  const [blogs, setBlogs] = useState([
    {
      title: "Mi nueva web hellokittyOnline",
      body: "lorem ipsum",
      author: "Pepe",
      id: 1,
    },
    {
      title: "HellokittyOnline 2",
      body: "lorem ipsum 7",
      author: "EUPepe",
      id: 2,
    },
    {
      title: "El refgreso de Hellokitty",
      body: "lorem 77",
      author: "Asder",
      id: 3,
    },
  ]);
  return (
    <div className="Home">
      {blogs.map((blog) => (
        <div className="blog-preview" key={blog.id}>
          <h2>{blog.title}</h2>
          <p>Escrito por {blog.author}</p>
        </div>
      ))}
    </div>
  );
};

export default Home;
