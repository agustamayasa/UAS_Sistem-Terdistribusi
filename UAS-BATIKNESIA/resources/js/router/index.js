import { createRouter, createWebHistory } from "vue-router";
import ExampleComponent from './components/ExampleComponent.vue';
import AboutComponent from './components/AboutComponent.vue';

import Product from './components/Products.vue';
import AddProduct from './components/Addproduct.vue';
import EditProduct from './components/EditProduct.vue';

const routes = [
  {
    path: '/',
    component: ExampleComponent
  },
  {
    path: '/about',
    component: AboutComponent
  },
  {
    name: 'product.create',
    path: '/vue/product/create',
    component: AddProduct
},
{
  name: 'product',
  path: '/vue/product',
  component: Product
},
{
  name: 'product.edit',
  path: '/vue/product/edit:id',
  component: EditProduct
},
  
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
