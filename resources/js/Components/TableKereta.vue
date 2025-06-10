<template>
    <div>
        <button @click="showModal('add')"
            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Add</button>
    </div>
    <div>
        <button @click="confirmDeleteMultiple" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
            :disabled="!selectedItems.length">Delete Selected Kereta</button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">
                        <input type="checkbox" @click="toggleSelectAll">
                    </th>
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Kereta</th>
                    <th class="py-2 px-4">Deskripsi</th>
                    <th class="py-2 px-4">Kelas</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in kereta" :key="item.id" class="border-t border-gray-200 dark:border-gray-700">
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <input type="checkbox" v-model="selectedItems" :value="item.id"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    </td>
                    <td class="py-2 px-4">{{ item.id }}</td>
                    <td class="py-2 px-4">{{ item.kereta }}</td>
                    <td class="py-2 px-4">{{ item.deskripsi }}</td>
                    <td class="py-2 px-4">{{ item.kelas }}</td>
                    <td class="py-2 px-4">
                        <button @click="showModal('edit', item)"
                            class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">Edit</button>
                        <!-- <button @click="confirmDelete(id)"
                            class="px-3 py-1 text-white bg-red-500 hover:bg-red-600 rounded ml-2">Delete</button> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">{{ modalType === 'add' ? 'Add Kereta' : 'Edit Kereta' }}</h2>
            <form @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <label class="block text-black">Nama Kereta</label>
                    <input v-model="formData.kereta" type="text" class="border p-2 w-full rounded" required />
                </div>
                <div class="mb-4">
                    <label class="block text-black">Deskripsi</label>
                    <input v-model="formData.deskripsi" type="text" class="border p-2 w-full rounded" required />
                </div>
                <div class="mb-4">
                    <label class="block text-black">Kelas</label>
                    <input v-model="formData.kelas" type="text" class="border p-2 w-full rounded" required />
                </div>
                <div class="flex space-x-4 ">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                    <button @click="isModalOpen = false" type="button"
                        class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div v-if="isDeleteModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4 text-black">Confirm Deletion</h2>
            <p class="mb-4 text-black">Are you sure you want to delete the selected kereta?</p>
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
        const kereta = ref([]);
        const isModalOpen = ref(false);
        const selectedItems = ref([]);
        const modalType = ref('add');
        const formData = ref({ id: null, kereta: '', deskripsi: '', kelas: '' });
        const isDeleteModalOpen = ref(false);
        const itemIdToDelete = ref(null);

        const fetchKereta = async () => {
            try {
                const response = await axios.get('/api/kereta');
                kereta.value = response.data;
            } catch (error) {
                console.error('Error fetching kereta:', error);
            }
        };

        const showModal = (type, item = null) => {
            modalType.value = type;
            isModalOpen.value = true;
            if (type === 'edit' && item) {
                formData.value = { ...item };
            } else {
                formData.value = { id: null, kereta: '', deskripsi: '', kelas: '' };
            }
        };

        const handleSubmit = async () => {
            try {
                if (modalType.value === 'add') {
                    await axios.post('/api/kereta', formData.value);
                } else {
                    await axios.put(`/api/kereta/${formData.value.id}`, formData.value);
                }
                fetchKereta();
                isModalOpen.value = false;
            } catch (error) {
                console.error('Error saving kereta:', error);
            }
        };

        const toggleSelectAll = () => {
            if (selectedItems.value.length === kereta.value.length) {
                selectedItems.value = [];
            } else {
                selectedItems.value = kereta.value.map(item => item.id);
            }
        };

        const confirmDelete = (id = null) => {
            itemIdToDelete.value = id;
            isDeleteModalOpen.value = true;
        };

        const handleDelete = async () => {
            try {
                await axios.delete(`/api/kereta/${itemIdToDelete.value}`);
                await fetchKereta();
                isDeleteModalOpen.value = false;
            } catch (error) {
                console.error('Error deleting data:', error);
            }
        };

        const confirmDeleteMultiple = async () => {
            try {
                await Promise.all(selectedItems.value.map(id => axios.delete(`/api/kereta/${id}`)));
                await fetchKereta();
                selectedItems.value = [];
                isDeleteModalOpen.value = false;
            } catch (error) {
                console.error('Error deleting multiple:', error);
            }
        };

        onMounted(fetchKereta);

        return {
            kereta, isModalOpen, modalType, formData, showModal, handleSubmit, confirmDelete, handleDelete, confirmDeleteMultiple,
            toggleSelectAll, selectedItems
        };
    },
};
</script>
