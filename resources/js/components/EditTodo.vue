<template>
    <div v-if="todo" class="max-w-xl mx-auto my-10 p-7 bg-gray-700 text-white rounded-md shadow-xl">
        <div v-if="successMessage" class="text-green-500 flex justify-center my-2 items-center space-x-1">
            <CircleCheck class="w-5 h-5 " />
            <span class="font-bold"> {{ successMessage }} </span>
        </div>
        <form v-else @submit.prevent="updateTodo">
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-2xl font-semibold text-white">Edit Todo</h1>
                <span class="text-sm text-gray-400 flex items-center">
                    <Fingerprint class="mr-1" /> {{ $route.params.id }}
                </span>
            </div>
            <div class="mb-4">
                <label for="title" class="text-gray-400">Title</label>
                <input type="text" name="title" v-model="todo.title"
                    class="bg-gray-800 text-white border-2 border-gray-600 rounded-md px-4 py-2 w-full focus:outline-none focus:border-indigo-500"
                    required />
                <p v-if="errors.title" class="text-red-500">{{ errors.title[0] }}</p>
            </div>
            <div class="mb-4">
                <label for="description" class="text-gray-400">Description</label>
                <textarea name="description" v-model="todo.description" placeholder="Todo Description"
                    class="bg-gray-800 text-white border-2 border-gray-600 rounded-md px-4 py-2 w-full h-24 focus:outline-none focus:border-indigo-500"
                    required></textarea>
                <p v-if="errors.description" class="text-red-500">{{ errors.description[0] }}</p>
            </div>
            <div class="mb-4">
                <label for="status" class="text-gray-400">Status</label>
                <select name="status" v-model="todo.status"
                    class="bg-gray-800 text-white border-2 border-gray-600 rounded-md px-4 py-2 w-full focus:outline-none focus:border-indigo-500">
                    <option value="open">Open</option>
                    <option value="in-progress">In progress</option>
                    <option value="completed">Completed</option>
                </select>
                <p v-if="errors.status" class="text-red-500">{{ errors.status[0] }}</p>
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
import { Fingerprint, CircleCheck } from 'lucide-vue-next';

export default {
    components: {
        Fingerprint,
        CircleCheck,
    },
    data() {
        return {
            todo: {
                title: '',
                description: '',
                status: '',
            },
            errors: {},
            successMessage: '',
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
                    // Set success message
                    this.successMessage = 'Todo updated successfully!';
                    // Clear form fields
                    this.todo.title = '';
                    this.todo.description = '';
                    // Delay for showing success animation
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        // Display validation errors
                        this.errors = error.response.data.errors;
                    } else {
                        console.error("Error updating Todo:", error.response.data);
                    }
                });
        }
    }
};
</script>
