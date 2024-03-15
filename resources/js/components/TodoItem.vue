<template>
    <li class="rounded-md my-5 p-4 bg-gray-800 shadow">
        <div class="mb-3 flex items-center justify-between">
            <strong class="text-lg">{{ todo.title }}</strong>
            <span class=" text-gray-600 flex items-center text-sm">
                <Fingerprint class="mr-1 h-4 w-4" /> {{ todo.id }}
            </span>
        </div>
        <section class="space-y-5">
            <div class="flex justify-between">
                <p class="text-gray-400">{{ todo.description }}</p>
                <div class="flex items-center space-x-3 mt-4 sm:mt-0">
                    <a :href="`/edit/${todo.id}`" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                        <Pencil class="w-5 h-5" />
                    </a>
                    <button @click="deleteTodoConfirmation(todo)"
                        class="text-red-500 hover:text-red-700 focus:outline-none">
                        <Trash class="w-5 h-5" />
                    </button>
                </div>
            </div>
            <div class="flex justify-between">
                <TodoStatus :todo="todo" />
                <span class="text-sm text-gray-600 flex items-center">
                    Made {{ formatDate(todo.created_at) }}
                </span>
            </div>
        </section>

        <DeleteModal :todo="todo" @todo-deleted="handleTodoDeleted" @close-modal="handleCloseModal" />

    </li>
</template>

<script>
import axios from "axios";
import { Trash, Pencil, Fingerprint } from 'lucide-vue-next';

import DeleteModal from "@/components/DeleteModal.vue";
import TodoStatus from "@/components/TodoStatus.vue";


export default {
    components: {
        Pencil,
        Trash,
        Fingerprint,

        DeleteModal,
        TodoStatus,
    },
    data() {
        return {
            deleteTodoId: null,
            deleteTodoTitle: null,
        };
    },
    props: {
        todo: {
            type: Object,
            required: true
        }
    },
    methods: {
        // delete
        deleteTodoConfirmation(todo) {
            this.deleteTodoId = todo ? todo.id : null;
            this.deleteTodoTitle = todo ? todo.title : null;
            const modal = document.getElementById('delete-modal-' + this.deleteTodoId);
            modal.classList.toggle('hidden');
            modal.classList.add('flex');
        },
        handleTodoDeleted() {
            location.reload();
        },
        handleCloseModal() {
            const modal = document.getElementById('delete-modal-' + this.deleteTodoId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        },

        // change status
        changeStatus(status) {
            if (status === this.todo.status) {
                return;
            }
            this.todo.status = status;

            // Update status in the database
            axios
                .put(`/admin/update/${this.todo.id}`, { status: status })
                .then((response) => {
                    location.reload();
                })
                .catch((error) => {
                    console.error("Error updating status:", error.response.data);
                })
        },

        // date format
        formatDate(timestamp) {
            const date = new Date(timestamp);
            return date.toLocaleDateString();
        },
    }
};
</script>
