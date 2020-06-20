import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import CreateCategory from './components/admin/categories/Create';
import EditCategory from './components/admin/categories/Edit';
import Categories from './components/admin/categories/List';
import AddSub from "./components/admin/categories/AddSub";
import AddField from "./components/admin/categories/AddField";
import FieldIndex from './components/admin/fields/Index';
import FieldCreate from './components/admin/fields/Create';
import FieldEdit from './components/admin/fields/Edit';
import FieldCreateOption from './components/admin/fields/options/Create';
import FieldEditOption from './components/admin/fields/options/Edit';
import FieldOptions from './components/admin/fields/options/Index';
import FieldAttachCategory from './components/admin/fields/AddCategory';
import PostEdit from "./components/admin/posts/PostEdit";
import PostIndex from "./components/admin/posts/PostIndex";
import PostCreate from "./components/admin/posts/PostCreate";

 const routes = [
     {
       path: '/posts',
       name: 'Posts',
       component: PostIndex
     },
     {
         path: '/posts/create',
         name: 'PostCreate',
         component: PostCreate
     },
     {
         path: '/posts/:postId/edit',
         name: 'PostEdit',
         component: PostEdit
     },
    {
        path: '/categories/create',
        name: 'CreateCategories',
        component: CreateCategory,
    },
    {
        path: '/categories/edit/:categoryId',
        name: 'EditCategories',
        component: EditCategory
    },
    {
        path: '/categories',
        name: 'Categories',
        component: Categories
    },
     {
         path: '/categories/:categoryId/addSubs',
         name: 'AddSubs',
         component: AddSub
     },
     {
         path: '/categories/:categoryId/fields/create',
         name: 'AddField',
         component: AddField
     },
     {
         path: '/fields',
         name: 'Fields',
         component: FieldIndex,
     },
     {
         path: '/fields/create',
         name: 'FieldCreate',
         component: FieldCreate
     },
     {
         path: '/fields/:fieldId',
         name: 'FieldEdit',
         component: FieldEdit,
     },
     {
         path: '/fields/:fieldId/categories/attach',
         name: 'FieldAttachCategory',
         component: FieldAttachCategory,
     },
     {
         path: '/fields/:fieldId/option',
         name: 'FieldOptions',
         component: FieldOptions,
     },
     {
         path: '/fields/:fieldId/option/create',
         name: 'FieldCreateOption',
         component: FieldCreateOption,
     },
     {
         path: '/fields/:fieldId/option/:optionId/edit',
         name: 'FieldEditOption',
         component: FieldEditOption,
     },


];

const router = new VueRouter({
    routes,
    mode: 'hash'
});

export default router;
