<template>
    <div>
        <h2>Add Todo</h2>
        <form @submit.prevent="addTodo">
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" v-model="title" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" v-model="description" required></textarea>
            </div>
            <div>
                <button type="submit">Add Todo</button>
            </div>
        </form>
        <a href="/">Back to overview</a>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            title: '',
            description: ''
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
                    console.log(response.data.message);
                    this.$router.go(-1);
                })
                .catch(error => {
                    console.error('Error adding Todo:', error.response.data);
                });
        }
    }
};
</script>