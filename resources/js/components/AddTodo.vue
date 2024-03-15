<template>
    <div class="max-w-xl mx-auto my-10 p-7 bg-gray-700 text-white rounded-md shadow-xl">
        <h2 class="text-2xl font-semibold mb-4 text-white">Add Todo</h2>
        <form @submit.prevent="addTodo">
            <p v-if="errorMessage" class="text-red-500 flex justify-center my-2">{{ errorMessage }}</p>

            <div class="mb-4">
                <label for="title" class="text-gray-400">Title:</label>
                <input type="text" id="title" v-model="title" placeholder="Todo Title"
                    class="bg-gray-800 text-white border-2 border-gray-600 rounded-md px-4 py-2 w-full focus:outline-none focus:border-indigo-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="description" class="text-gray-400">Description:</label>
                <textarea id="description" v-model="description" placeholder="Todo Description"
                    class="bg-gray-800 text-white border-2 border-gray-600 rounded-md px-4 py-2 w-full h-24 focus:outline-none focus:border-indigo-500"
                    required></textarea>
            </div>
            <div class="flex items-center justify-between">
                <a href="/"
                    class="bg-gray-400 hover:bg-gray-500 text-white px-3 py-2 rounded-md cursor-pointer focus:outline-none">Cancel</a>
                <input type="submit" value="Add Todo"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-2 rounded-md cursor-pointer focus:outline-none">
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            title: '',
            description: '',
            errorMessage: ''
        };
    },
    methods: {
        addTodo() {
            const newTodo = {
                title: this.title,
                description: this.description
            };
            axios.post('/store', newTodo)
                .then(response => {
                    window.location.href = '/';
                })
                .catch(error => {
                    console.error('Error adding Todo:', error);
                    if (error.response && error.response.status === 500) {
                        this.errorMessage = 'Internal server error. Please try again later.';
                    } else {
                        this.errorMessage = 'An error occurred while adding the todo.';
                    }
                });
        },
    }
};
</script>
