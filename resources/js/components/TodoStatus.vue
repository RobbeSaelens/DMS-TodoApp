<template>
    <span v-if="todo.status === 'open'" title="Click to set in progress"
        class="text-indigo-500 hover:text-indigo-600 flex items-center space-x-1 cursor-pointer"
        @click="changeStatus('in-progress')">
        <CircleDashed class="w-5 h-5" />
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
</template>

<script>
import axios from "axios";
import { CircleDashed, Pickaxe, CircleCheck } from 'lucide-vue-next';


export default {
    components: {
        CircleDashed,
        Pickaxe,
        CircleCheck,
    },
    props: {
        todo: {
            type: Object,
            required: true
        }
    },
    methods: {
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
                });
        }
    }
};
</script>
