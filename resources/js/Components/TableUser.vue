<template>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">ID</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Name</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Role</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Email</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id" class="border-t border-gray-200 dark:border-gray-700">
                    <td class="py-2 px-4">{{ user.id }}</td>
                    <td class="py-2 px-4">{{ user.name }}</td>
                    <td class="py-2 px-4">{{ user.role }}</td>
                    <td class="py-2 px-4">{{ user.email }}</td>
                    <!-- <td class="py-2 px-4"> -->
                    <!-- Tombol Edit dan Hapus -->
                    <!-- <button class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">
                            Edit
                        </button>
                        <button class="px-3 py-1 text-white bg-red-500 hover:bg-red-600 rounded ml-2">
                            Delete
                        </button> -->
                    <!-- </td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios'; // Untuk melakukan request ke API (jika data berasal dari backend)

export default {
    setup() {
        // Data user (sementara bisa hardcoded atau diambil dari API)
        const users = ref([]);

        const fetchUsers = async () => {
            try {
                const response = await axios.get('/api/users');
                console.log('Response:', response); // Periksa response
                users.value = response.data;
                console.log('Users:', users.value); // Periksa data users
            } catch (error) {
                console.error('Error fetching users:', error);
            }
        };

        onMounted(() => {
            console.log('Component mounted'); // Periksa lifecycle hook
            fetchUsers();
        });

        return { users };
    },
};
</script>
