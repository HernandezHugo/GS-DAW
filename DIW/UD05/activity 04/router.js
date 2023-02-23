
import Login from "./components/login.js";
import Registration from "./components/registration.js";
import Products from "./components/products.js";

const Home = { template: "<div>Home</div>" };

let router = VueRouter.createRouter({
  history: VueRouter.createWebHistory(),
  routes: [
    { path: "/", name: "Home", component: Home },
    { path: "/login", component: Login },
    { path: "/registration", component: Registration },
    { path: "/products", component: Products },
    { path: "/goodbye/:message", name: "Goodbye", component: Goodbye },
    { path: "/goodbye/:message", name: "Goodbye2", component: Goodbye },
  ],
});

export default router;
