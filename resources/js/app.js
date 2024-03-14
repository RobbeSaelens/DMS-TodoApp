import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";

import AddTodo from "./components/AddTodo.vue";
import TodoList from "./components/TodoList.vue";
import EditTodo from "./components/EditTodo.vue";

const routes = [
    {
        path: "/",
        name: "TodoList",
        component: TodoList,
    },
    {
        path: "/todos/create",
        name: "AddTodo",
        component: AddTodo,
    },
    {
        path: "/edit/:id",
        name: "EditTodo",
        component: EditTodo,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const app = createApp();

app.component("addtodo", AddTodo);
app.component("edittodo", EditTodo);
app.component("todolist", TodoList);

app.use(router);

app.mount("#app");
