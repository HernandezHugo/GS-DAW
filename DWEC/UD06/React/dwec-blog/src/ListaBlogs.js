const ListaBlogs = (props) => {
  const blogs = props.blogs;
  const title = props.title;

  
  return (
    <div className="blogs">
      <h1>{title}</h1>
      {blogs.map((blog) => (
        <div className="blog-preview" key={blog.id}>
          <h2>{blog.title}</h2>
          <p>{blog.body}</p>
          <p>{blog.author}</p>
          <button onClick={() => props.handleDeleteBlog(blog.id)}>delete</button>
        </div>
      ))}
    </div>
  );
};

export default ListaBlogs;
