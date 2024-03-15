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
        <ul>
            <li v-for="todo in todos" :key="todo.id" class="rounded-md my-5 p-4 bg-gray-800 shadow">
                <div class="mb-3">
                    <strong class="text-lg">{{ todo.title }}</strong>
                </div>
                <section class="space-y-1">
                    <div class="flex justify-between">
                        <p class="text-gray-400">{{ todo.description }}</p>
                        <div class="flex items-center space-x-3 mt-4 sm:mt-0">
                            <a :href="`/edit/${todo.id}`" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                                <Pencil class="w-5 h-5" />
                            </a>
                            <button @click="deleteTodo(todo.id)"
                                class="text-red-500 hover:text-red-700 focus:outline-none">
                                <Trash class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-5">
                        <span v-if="todo.status === 'open'" class="text-indigo-500 flex items-center space-x-1">
                            <CircleDashed class="w-5 h-5" />
                            <p>Open</p>
                        </span>
                        <span v-else-if="todo.status === 'in-progress'"
                            class="text-yellow-500 flex items-center space-x-1">
                            <Pickaxe class="w-5 h-5" />
                            <p>In Progress</p>
                        </span>
                        <span v-else-if="todo.status === 'completed'"
                            class="text-green-500 flex items-center space-x-1">
                            <CircleCheck class="w-5 h-5" />
                            <p>Completed</p>
                        </span>
                        <div class="text-gray-600 text-sm italic">
                            Created at: {{ formatDate(todo.created_at) }}
                        </div>
                    </div>
                </section>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";
import { Trash, Pencil, CirclePlus, CircleDashed, Pickaxe, CircleCheck, ListChecks } from 'lucide-vue-next';

export default {
    components: {
        Trash,
        Pencil,
        CirclePlus,
        CircleDashed,
        Pickaxe,
        CircleCheck,
        ListChecks,
    },
    data() {
        return {
            todos: [],
        };
    },
    created() {
        this.fetchTodos();
    },
    watch: {
        '$route'(to, from) {
            this.fetchTodos();
        }
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
        formatDate(timestamp) {
            const date = new Date(timestamp);
            return date.toLocaleDateString() + " at " + date.toTimeString().slice(0, 5) + "h";
        }
    },
};
</script>
