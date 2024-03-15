<template>
    <div v-if="todo">
        <h1>Edit Todo with ID: {{ $route.params.id }}</h1>
        <form @submit.prevent="updateTodo">
            <div>
                <input type="text" name="title" v-model="todo.title" />
            </div>
            <div>
                <textarea name="description" v-model="todo.description" placeholder="Todo Description"></textarea>
            </div>
            <div>
                <select name="status" v-model="todo.status">
                    <option value="open">Open</option>
                    <option value="in-progress">In progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <input type="submit" value="Update" />
        </form>
    </div>
    <div v-else>
        Loading...
    </div>
</template>

<script>
import axios from "axios";

export default {
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
                .get(`/todo/${id}`)
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
                .put(`/update/${id}`, this.todo)
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
