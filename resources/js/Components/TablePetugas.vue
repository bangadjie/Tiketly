<template>
    <div class="mb-4 flex space-x-4">
        <div>
            <button @click="showModal('add')"
                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Add Petugas</button>
        </div>
        <div>
            <button @click="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                :disabled="!selectedItems.length">Delete Selected Petugas</button>
        </div>
    </div>

    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-xl font-bold mb-4">{{ modalType === 'add' ? 'Add Petugas' : 'Edit Petugas' }}</h2>
            <form @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-black">Nama Petugas</label>
                    <input v-model="formData.petugas" type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-black">Alamat</label>
                    <input v-model="formData.alamat" type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-black">Telepon</label>
                    <input v-model="formData.telp" type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-black">ID User</label>
                    <input v-model="formData.id_user" type="number"
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
                    <th class="px-6 py-3">
                        <input type="checkbox" @click="toggleSelectAll">
                    </th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">ID</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Nama Petugas</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Alamat</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Telepon</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">ID User</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="petugasItem in petugas" :key="petugasItem.id"
                    class="border-t border-gray-200 dark:border-gray-700">
                    <td class="px-6 py-4">
                        <input type="checkbox" v-model="selectedItems" :value="petugasItem.id"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    </td>
                    <td class="py-2 px-4">{{ petugasItem.id }}</td>
                    <td class="py-2 px-4">{{ petugasItem.petugas }}</td>
                    <td class="py-2 px-4">{{ petugasItem.alamat }}</td>
                    <td class="py-2 px-4">{{ petugasItem.telp }}</td>
                    <td class="py-2 px-4">{{ petugasItem.id_user }}</td>
                    <td class="py-2 px-4">
                        <button @click="showModal('edit', petugasItem)"
                            class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-if="isDeleteModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4 text-black">Confirm Deletion</h2>
            <p class="mb-4 text-black">Are you sure you want to delete the selected petugas?</p>
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
        const petugas = ref([]);
        const selectedItems = ref([]);
        const isModalOpen = ref(false);
        const modalType = ref('add');
        const formData = ref({ petugas: '', alamat: '', telp: '', id_user: '' });
        const isDeleteModalOpen = ref(false);
        const itemIdToDelete = ref(null);

        const fetchPetugas = async () => {
            try {
                const response = await axios.get('/api/petugas');
                petugas.value = response.data;
            } catch (error) {
                console.error('Error fetching petugas:', error);
            }
        };

        const showModal = (type, data = null) => {
            modalType.value = type;
            formData.value = type === 'edit' && data ? { ...data } : { petugas: '', alamat: '', telp: '', id_user: '' };
            isModalOpen.value = true;
        };

        const handleSubmit = async () => {
            try {
                if (modalType.value === 'add') {
                    await axios.post('/api/petugas', formData.value);
                } else {
                    await axios.put(`/api/petugas/${formData.value.id}`, formData.value);
                }
                fetchPetugas();
                isModalOpen.value = false;
            } catch (error) {
                console.error('Error saving petugas:', error);
            }
        };

        const toggleSelectAll = () => {
            selectedItems.value = selectedItems.value.length === petugas.value.length ? [] : petugas.value.map(p => p.id);
        };

        const confirmDeleteMultiple = async () => {
            try {
                await Promise.all(selectedItems.value.map(id => axios.delete(`/api/petugas/${id}`)));
                fetchPetugas();
                selectedItems.value = [];
                isDeleteModalOpen.value = false;
            } catch (error) {
                console.error('Error deleting multiple:', error);
            }
        };

        onMounted(fetchPetugas);

        return { petugas, isModalOpen, modalType, formData, showModal, handleSubmit, toggleSelectAll, selectedItems, isDeleteModalOpen, confirmDeleteMultiple };
    },
};
</script>
