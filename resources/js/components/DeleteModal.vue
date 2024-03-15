<template>
    <div :id="'delete-modal-' + todo.id" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center bg-black bg-opacity-80">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="bg-gray-800 rounded-lg shadow p-2">
                <div class="py-5 text-center items-center text-gray-500">
                    <h3 class="text-lg font-normal">Are you sure you
                        want to delete</h3>
                    <strong class="block mb-5">{{ todo.title }}</strong>
                    <button type="button" @click="deleteTodo"
                        class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-800
                              bg-white rounded-lg hover:bg-gray-100 hover:text-gray-900" @click="closeModal">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        todo: {
            type: Object,
            required: true
        }
    },
    methods: {
        deleteTodo() {
            axios.delete(`/admin/delete/${this.todo.id}`)
                .then(() => {
                    this.closeModal();
                    this.$emit('todo-deleted');
                })
                .catch((error) => {
                    console.error("Error deleting Todo:", error.response.data);
                });
        },
        closeModal() {
            this.$emit('close-modal');
        }
    }
};
</script>
