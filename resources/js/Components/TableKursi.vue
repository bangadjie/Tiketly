<template>
    <div class="mb-4 flex space-x-4">
        <button @click="showModal('add')"
            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Add</button>
        <button @click="confirmDeleteMultiple" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
            :disabled="!selectedItems.length">
            Delete Selected Kursi
        </button>
    </div>

    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-xl font-bold mb-4">{{ modalType === 'add' ? 'Add Kursi' : 'Edit Kursi' }}</h2>
            <form @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <label for="no_kursi" class="block text-sm font-medium text-black">Nomor Kursi</label>
                    <input v-model="formData.no_kursi" type="text" id="no_kursi"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="id_gerbong" class="block text-sm font-medium text-black">ID Gerbong</label>
                    <input v-model="formData.id_gerbong" type="text" id="id_gerbong"
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

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">
                        <input type="checkbox" @click="toggleSelectAll">
                    </th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">ID</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Nomor Kursi</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">ID Gerbong</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in kursi" :key="item.id" class="border-t border-gray-200 dark:border-gray-700">
                    <td class="px-6 py-4">
                        <input type="checkbox" v-model="selectedItems" :value="item.id"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    </td>
                    <td class="py-2 px-4">{{ item.id }}</td>
                    <td class="py-2 px-4">{{ item.no_kursi }}</td>
                    <td class="py-2 px-4">{{ item.id_gerbong }}</td>
                    <td class="py-2 px-4">
                        <button @click="showModal('edit', item)"
                            class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">Edit</button>
                        <button @click="confirmDelete(item.id)"
                            class="px-3 py-1 text-white bg-red-500 hover:bg-red-600 rounded ml-2">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-if="isDeleteModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4 text-black">Confirm Deletion</h2>
            <p class="mb-4 text-black">Are you sure you want to delete the selected kursi?</p>
            <div class="flex space-x-4">
                <button @click="handleDelete"
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
        const kursi = ref([]);
        const selectedItems = ref([]);
        const isModalOpen = ref(false);
        const modalType = ref('add');
        const formData = ref({ no_kursi: '', id_gerbong: '' });
        const isDeleteModalOpen = ref(false);
        const itemIdToDelete = ref(null);

        const fetchKursi = async () => {
            try {
                const response = await axios.get('/api/kursi');
                kursi.value = response.data;
            } catch (error) {
                console.error('Error fetching kursi:', error);
            }
        };

        const showModal = (type, data = null) => {
            modalType.value = type;
            if (type === 'edit' && data) {
                formData.value = { ...data };
            } else {
                formData.value = { no_kursi: '', id_gerbong: '' };
            }
            isModalOpen.value = true;
        };

        const handleSubmit = async () => {
            try {
                if (modalType.value === 'add') {
                    await axios.post('/api/kursi', formData.value);
                } else {
                    await axios.put(`/api/kursi/${formData.value.id}`, formData.value);
                }
                fetchKursi();
                isModalOpen.value = false;
            } catch (error) {
                console.error('Error saving kursi:', error);
            }
        };

        const toggleSelectAll = () => {
            if (selectedItems.value.length === kursi.value.length) {
                selectedItems.value = [];
            } else {
                selectedItems.value = kursi.value.map(k => k.id);
            }
        };

        const confirmDelete = (id = null) => {
            itemIdToDelete.value = id;
            isDeleteModalOpen.value = true;
        };

        const handleDelete = async () => {
            try {
                await axios.delete(`/api/kursi/${itemIdToDelete.value}`);
                await fetchKursi();
                isDeleteModalOpen.value = false;
            } catch (error) {
                console.error('Error deleting kursi:', error);
            }
        };

        const confirmDeleteMultiple = async () => {
            try {
                await Promise.all(selectedItems.value.map(id => axios.delete(`/api/kursi/${id}`)));
                await fetchKursi();
                selectedItems.value = [];
                isDeleteModalOpen.value = false;
            } catch (error) {
                console.error('Error deleting multiple kursi:', error);
            }
        };

        onMounted(fetchKursi);

        return {
            kursi,
            isModalOpen,
            modalType,
            formData,
            showModal,
            handleSubmit,
            toggleSelectAll,
            selectedItems,
            isDeleteModalOpen,
            confirmDelete,
            handleDelete,
            confirmDeleteMultiple
        };
    },
};
</script>
