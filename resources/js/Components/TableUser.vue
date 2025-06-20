<template>
    <div>
        <button @click="showModal('add')"
            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Add</button>
    </div>

    <div>
        <button @click="confirmDeleteMultiple" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
            :disabled="!selectedItems.length">Delete Selected User</button>
    </div>

    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-xl font-bold mb-4">{{ modalType === 'add' ? 'Add User' : 'Edit User' }}</h2>
            <form @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <label for="Nama" class="block text-sm font-medium text-black">Nama</label>
                    <input v-model="formData.name" type="text" id="name"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select v-model="formData.role" id="role"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black">
                        <option v-for="role in roles" :key="role" :value="role">{{ role }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="Email" class="block text-sm font-medium text-black">Email</label>
                    <input v-model="formData.email" type="text" id="email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>


                <div class="flex space-x-4 mt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Save</button>
                    <button @click="isModalOpen = false" type="button"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">
                        <input type="checkbox" @click="toggleSelectAll">
                    </th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">ID</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Name</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Role</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Email</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id" class="border-t border-gray-200 dark:border-gray-700">
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <input type="checkbox" v-model="selectedItems" :value="user.id"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    </td>
                    <td class="py-2 px-4">{{ user.id }}</td>
                    <td class="py-2 px-4">{{ user.name }}</td>
                    <td class="py-2 px-4">{{ user.role }}</td>
                    <td class="py-2 px-4">{{ user.email }}</td>
                    <td class="py-2 px-4">
                        <!-- Tombol Edit dan Hapus -->
                        <button @click="showModal('edit', user)"
                            class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">
                            Edit
                        </button>
                        <!-- <button class="px-3 py-1 text-white bg-red-500 hover:bg-red-600 rounded ml-2">
                            Delete
                        </button> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-if="isDeleteModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4 text-black">Confirm Deletion</h2>
            <p class="mb-4 text-black">Are you sure you want to delete the selected User?</p>
            <div class="flex space-x-4">
                <button @click="confirmDeleteMultiple"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Delete</button>
                <button @click="isDeleteModalOpen = false" type="button"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {

        const users = ref([]);
        const formData = ref({ name: '', role: '', email: '' });
        const roles = ref(["pengguna", "admin"]);
        const isModalOpen = ref(false);
        const modalType = ref('add');
        const isDeleteModalOpen = ref(false);
        const itemIdToDelete = ref(null);
        const selectedItems = ref([]);


        const fetchUsers = async () => {
            try {
                const response = await axios.get('/api/users');
                console.log('Response:', response);
                users.value = response.data;
                console.log('Users:', users.value.length);
            } catch (error) {
                console.error('Error fetching users:', error);
            }
        };

        const showModal = (type, data = null) => {
            modalType.value = type;
            if (type === 'edit' && data) {
                formData.value = { ...data };
            } else {
                formData.value = { name: '', role: '', email: '' };
            }
            isModalOpen.value = true;
        };

        const handleSubmit = async () => {
            try {
                if (modalType.value === 'add') {
                    await axios.post('/api/users', formData.value);
                    users.value.push(response.data);
                } else {
                    await axios.put(`/api/users/${formData.value.id}`, formData.value);
                }
                fetchUsers();
                isModalOpen.value = false;
            } catch (error) {
                console.error('Error saving user:', error);
            }
        };

        const toggleSelectAll = () => {
            if (selectedItems.value.length === users.value.length) {
                selectedItems.value = [];
            } else {
                selectedItems.value = users.value.map(user => user.id);
            }
        };

        const confirmDelete = (id = null) => {
            itemIdToDelete.value = id;
            isDeleteModalOpen.value = true;
        };

        const handleDelete = async () => {
            try {
                await axios.delete(`/api/users/${itemIdToDelete.value}`);
                await fetchUsers();
                isDeleteModalOpen.value = false;
            } catch (error) {
                console.error('Error deleting data:', error);
            }
        };

        const confirmDeleteMultiple = async () => {
            try {
                await Promise.all(selectedItems.value.map(id => axios.delete(`/api/users/${id}`)));
                await fetchUsers();
                selectedItems.value = [];
                isDeleteModalOpen.value = false;
            } catch (error) {
                console.error('Error deleting multiple:', error);
            }
        };


        onMounted(() => {
            fetchUsers();
        });

        return {
            users,
            isModalOpen,
            modalType,
            formData,
            roles,
            showModal,
            selectedItems,
            handleSubmit,
            isDeleteModalOpen,
            confirmDelete,
            handleDelete,
            confirmDeleteMultiple,
            toggleSelectAll,
        };
    },
};
</script>
