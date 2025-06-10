<template>
    <div class="mb-4 flex space-x-4">
        <div>
            <button @click="showModal('add')"
                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Add</button>
        </div>
        <div>
            <button @click="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                :disabled="!selectedItems.length">Delete Selected Pelanggan</button>
        </div>
    </div>

    <!-- Modal Form -->
    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-xl font-bold mb-4">{{ modalType === 'add' ? 'Add Pelanggan' : 'Edit Pelanggan' }}</h2>
            <form @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <label for="nik" class="block text-sm font-medium text-black">NIK</label>
                    <input v-model="formData.NIK" type="text" id="nik"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-black">Alamat</label>
                    <input v-model="formData.alamat" type="text" id="alamat"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="telp" class="block text-sm font-medium text-black">Telepon</label>
                    <input v-model="formData.telp" type="text" id="telp"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="id_user" class="block text-sm font-medium text-black">ID User</label>
                    <input v-model="formData.id_user" type="number" id="id_user"
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

    <!-- Table -->
    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3">
                        <input type="checkbox" @click="toggleSelectAll">
                    </th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">ID</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">NIK</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Alamat</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Telepon</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">ID User</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="pelangganItem in pelanggan" :key="pelangganItem.id"
                    class="border-t border-gray-200 dark:border-gray-700">
                    <td class="px-6 py-4">
                        <input type="checkbox" v-model="selectedItems" :value="pelangganItem.id"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    </td>
                    <td class="py-2 px-4">{{ pelangganItem.id }}</td>
                    <td class="py-2 px-4">{{ pelangganItem.NIK }}</td>
                    <td class="py-2 px-4">{{ pelangganItem.alamat }}</td>
                    <td class="py-2 px-4">{{ pelangganItem.telp }}</td>
                    <td class="py-2 px-4">{{ pelangganItem.id_user }}</td>
                    <td class="py-2 px-4">
                        <button @click="showModal('edit', pelangganItem)"
                            class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const pelanggan = ref([]);
        const selectedItems = ref([]);
        const isModalOpen = ref(false);
        const modalType = ref('add');
        const formData = ref({ NIK: '', alamat: '', telp: '', id_user: '' });

        const fetchPelanggan = async () => {
            try {
                const response = await axios.get('/api/pelanggan');
                pelanggan.value = response.data;
            } catch (error) {
                console.error('Error fetching pelanggan:', error);
            }
        };

        const showModal = (type, data = null) => {
            modalType.value = type;
            if (type === 'edit' && data) {
                formData.value = { ...data };
            } else {
                formData.value = { NIK: '', alamat: '', telp: '', id_user: '' };
            }
            isModalOpen.value = true;
        };

        const handleSubmit = async () => {
            try {
                if (modalType.value === 'add') {
                    await axios.post('/api/pelanggan', formData.value);
                } else {
                    await axios.put(`/api/pelanggan/${formData.value.id}`, formData.value);
                }
                fetchPelanggan();
                isModalOpen.value = false;
            } catch (error) {
                console.error('Error saving pelanggan:', error);
            }
        };

        const toggleSelectAll = () => {
            if (selectedItems.value.length === pelanggan.value.length) {
                selectedItems.value = [];
            } else {
                selectedItems.value = pelanggan.value.map(pelanggan => pelanggan.id);
            }
        };

        const confirmDelete = async () => {
            try {
                await Promise.all(selectedItems.value.map(id => axios.delete(`/api/pelanggan/${id}`)));
                await fetchPelanggan();
                selectedItems.value = [];
            } catch (error) {
                console.error('Error deleting multiple:', error);
            }
        };

        onMounted(fetchPelanggan);

        return {
            pelanggan,
            isModalOpen,
            modalType,
            formData,
            showModal,
            handleSubmit,
            toggleSelectAll,
            selectedItems,
            confirmDelete
        };
    },
};
</script>
