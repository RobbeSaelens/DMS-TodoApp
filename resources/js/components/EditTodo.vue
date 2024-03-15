<template>
    <div v-if="todo" class="max-w-xl mx-auto my-10 p-7 bg-gray-700 text-white rounded-md shadow-xl">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-semibold text-white">Edit Todo</h1>
            <span class="text-sm text-gray-400 flex items-center">
                <Fingerprint class="mr-1" /> {{ $route.params.id }}
            </span>
        </div>
        <form @submit.prevent="updateTodo">
            <div class="mb-4">
                <label for="title" class="text-gray-400">Title</label>
                <input type="text" name="title" v-model="todo.title"
                    class="bg-gray-800 text-white border-2 border-gray-600 rounded-md px-4 py-2 w-full focus:outline-none focus:border-indigo-500" />
            </div>
            <div class="mb-4">
                <label for="description" class="text-gray-400">Description</label>
                <textarea name="description" v-model="todo.description" placeholder="Todo Description"
                    class="bg-gray-800 text-white border-2 border-gray-600 rounded-md px-4 py-2 w-full h-24 focus:outline-none focus:border-indigo-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="status" class="text-gray-400">Status</label>
                <select name="status" v-model="todo.status"
                    class="bg-gray-800 text-white border-2 border-gray-600 rounded-md px-4 py-2 w-full focus:outline-none focus:border-indigo-500">
                    <option value="open">Open</option>
                    <option value="in-progress">In progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="flex items-center justify-between">
                <a href="/"
                    class="bg-gray-400 hover:bg-gray-500 text-white px-3 py-2 rounded-md cursor-pointer focus:outline-none">Cancel</a>
                <input type="submit" value="Update Todo"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-2 rounded-md cursor-pointer focus:outline-none">
            </div>
        </form>
    </div>
    <div v-else>
        <div class="max-w-xl mx-auto my-10 p-7 bg-gray-700 text-white rounded-md shadow-xl">
            <p class="text-center text-gray-400">Loading...</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { Fingerprint } from 'lucide-vue-next';

export default {
    components: {
        Fingerprint
    },
    data() {
        return {
            todo: {
                title: '',
                description: '',
                status: ''
            }
        };
    },
    created() {
        this.fetchTodo();
    },
    methods: {
        fetchTodo() {
            const id = this.$route.params.id;
            if (!id) {
                setTimeout(() => {
                    this.fetchTodo();
                }, 1);
                return;
            }

            axios
                .get(`/admin/todo/${id}`)
                .then((response) => {
                    this.todo = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching Todo:", error.response.data);
                });
        },
        updateTodo() {
            const id = this.$route.params.id;
            axios
                .put(`/admin/update/${id}`, this.todo)
                .then((response) => {
                    window.location.href = "/";
                })
                .catch((error) => {
                    console.error("Error updating Todo:", error.response.data);
                });
        }
    }
};
</script>
