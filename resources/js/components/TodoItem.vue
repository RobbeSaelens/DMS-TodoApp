<template>
    <li class="rounded-md my-5 p-4 bg-gray-800 shadow">
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
                    <button @click="deleteTodoConfirmation(todo)"
                        class="text-red-500 hover:text-red-700 focus:outline-none">
                        <Trash class="w-5 h-5" />
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-between pt-5">
                <span v-if="todo.status === 'open'" title="Click to set in progress"
                    class="text-indigo-500 hover:text-indigo-600 flex items-center space-x-1 cursor-pointer"
                    @click="changeStatus('in-progress')">
                    <CircleDashed class=" w-5 h-5" />
                    <p>Open</p>
                </span>
                <span v-else-if="todo.status === 'in-progress'" title="Click to set completed"
                    class="text-yellow-500 hover:text-yellow-600 flex items-center space-x-1 cursor-pointer"
                    @click="changeStatus('completed')">
                    <Pickaxe class="w-5 h-5" />
                    <p>In Progress</p>
                </span>
                <span v-else-if="todo.status === 'completed'" title="Click to set open"
                    class="text-green-500 hover:text-green-600 flex items-center space-x-1 cursor-pointer"
                    @click="changeStatus('open')">
                    <CircleCheck class="w-5 h-5" />
                    <p>Completed</p>
                </span>
                <div class="text-gray-600 text-sm italic">
                    Made on: {{ formatDate(todo.created_at) }}
                </div>
            </div>
        </section>

        <DeleteModal :todo="todo" @todo-deleted="handleTodoDeleted" @close-modal="handleCloseModal" />

    </li>
</template>

<script>
import axios from "axios";
import { Trash, Pencil, CirclePlus, CircleDashed, Pickaxe, CircleCheck, ListChecks, CircleAlert, CircleX } from 'lucide-vue-next';
import DeleteModal from "@/components/DeleteModal.vue";

export default {
    components: {
        Trash,
        Pencil,
        CirclePlus,
        CircleDashed,
        Pickaxe,
        CircleCheck,
        ListChecks,
        CircleAlert,
        CircleX,

        DeleteModal
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
                .put(`/update-status/${this.todo.id}`, { status: status })
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
