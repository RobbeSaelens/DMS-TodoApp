<template>
    <div>
        <h2>Todos</h2>
        <ul>
            <li v-for="todo in todos" :key="todo.id">
                <strong>{{ todo.title }}</strong>: {{ todo.description }} ({{ todo.status }})
                <button @click="deleteTodo(todo.id)">
                    <Trash />
                </button>
                <a :href="`/edit/${todo.id}`">
                    <button>
                        <Pencil />
                    </button>
                </a>
            </li>
        </ul>
        <a href="/todos/create">Create Todo</a>
    </div>
</template>

<script>
import axios from "axios";
import { Trash, Pencil } from 'lucide-vue-next';

export default {
    components: {
        Trash,
        Pencil
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
        fetchTodos() {
            axios
                .get("/todos")
                .then((response) => {
                    this.todos = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching Todos:", error.response.data);
                });
        },
        deleteTodo(id) {
            axios
                .delete(`/delete/${id}`)
                .then((response) => {
                    console.log(response.data.message);
                    this.todos = this.todos.filter(todo => todo.id !== id);
                })
                .catch((error) => {
                    console.error("Error deleting Todo:", error.response.data);
                });
        },
    },
};
</script>
