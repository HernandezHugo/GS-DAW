import Login from "./components/login.js";
import Registration from "./components/registration.js";
import Products from "./components/products.js";


const routes = [
  { path: "/", name: "Home",  redirect: "/login" },
  { path: "/login", component: Login },
  { path: "/registration", component: Registration },
  { path: "/products", component: Products,},
];

const { createRouter, createWebHashHistory } = VueRouter;

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
