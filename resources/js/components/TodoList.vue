<template>
    <div class="max-w-xl mx-auto my-10 p-7 bg-gray-700 text-white rounded-md shadow-xl">
        <div class="flex justify-between">
            <div class="text-2xl font-semibold mb-4 flex items-center space-x-2 text-white">
                <ListChecks class="w-8 h-8 " />
                <p>Todo list</p>
            </div>
            <a href="/todos/create">
                <CirclePlus class="w-8 h-8 text-indigo-500 hover:text-indigo-600" />
            </a>
        </div>
        <div class="mb-4 space-y-1">
            <p class="flex items-center text-gray-300 font-medium">Welcome to your Todo list!
                <Hand class="ml-1" />
            </p>
            <p class="text-gray-400">Click on the status to change it or click on
                the pencil to
                edit the todo. </p>
        </div>
        <hr class="border-gray-500 w-1/2 mx-auto mb-2" />
        <div class="flex justify-center text-gray-400 text-sm italic">
            Today: {{ today() }}
        </div>
        <ul v-if="todos.length">
            <TodoItem v-for="todo in todos" :key="todo.id" :todo="todo" />
        </ul>
        <ul v-else class="text-center text-gray-400 mt-5">
            <li class="rounded-md my-5 p-4 bg-gray-800 shadow">
                <p cla>No todos found.</p>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";
import { CirclePlus, ListChecks, Hand } from 'lucide-vue-next';

import TodoItem from "./TodoItem.vue";

export default {
    components: {
        CirclePlus,
        ListChecks,
        Hand,

        TodoItem,
    },
    data() {
        return {
            todos: [],
        };
    },
    created() {
        this.fetchTodos();
    },
    methods: {
        // fetch all todos
        fetchTodos() {
            axios
                .get("/admin/todos")
                .then((response) => {
                    this.todos = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching Todos:", error.response.data);
                });
        },

        // today
        today() {
            return new Date().toLocaleDateString();
        },
    },
};
</script>
