import { useState, useEffect } from "react";
import ListaBlogs from "./ListaBlogs";

const Home = () => {
  const [blogs, setBlogs] = useState(null);

  const [name, setName] = useState("Luis");

  const handleDeleteBlog = (id) => {
    const blogsAux = blogs.filter((b) => b.id != id);
    setBlogs(blogsAux);
  };

  useEffect(() => {
    //console.log(blogs);
    //console.log(name);
    fetch("http://localhost:3000/blogs")
      .then((res) => {
        console.log(res);;
      })
  }, []);

  return (
    <div className="home">
      {/* 
      {blogs.map((blog) => (
        <div className="blog-preview" key={blog.id}>
          <h2>{blog.title}</h2>
          <p>Escrito por {blog.author}</p>
        </div>
      ))}
     */}
      {/* <ListaBlogs
        blogs={blogs}
        titulo="props blogs"
        handleDeleteBlog={handleDeleteBlog}
      ></ListaBlogs>
      <button onClick={()=>{setName("JOSE")}}>Change name</button>
      <p>{name}</p> */}
    </div>
  );
};

export default Home;
