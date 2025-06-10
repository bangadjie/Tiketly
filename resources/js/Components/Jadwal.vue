<template>
    <div class="mb-4 flex space-x-4">
        <div>
            <button @click="showModal('add')"
                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Add</button>
        </div>
        <div>
            <button @click="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                :disabled="!selectedItems.length">Delete Selected Jadwal</button>
        </div>
    </div>
    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-xl font-bold mb-4">{{ modalType === 'add' ? 'Add Jadwal' : 'Edit Jadwal' }}</h2>
            <form @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <label for="asal_keberangkatan" class="block text-sm font-medium text-black">Asal
                        Keberangkatan</label>
                    <input v-model="formData.asal_keberangkatan" type="text" id="asal_keberangkatan"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="tujuan_keberangkatan" class="block text-sm font-medium text-black">Tujuan
                        Keberangkatan</label>
                    <input v-model="formData.tujuan_keberangkatan" type="text" id="tujuan_keberangkatan"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="keberangkatan" class="block text-sm font-medium text-black">Keberangkatan</label>
                    <input v-model="formData.keberangkatan" type="date" id="keberangkatan"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="kedatangan" class="block text-sm font-medium text-black">Kedatangan</label>
                    <input v-model="formData.kedatangan" type="date" id="kedatangan"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-black">Harga</label>
                    <input v-model="formData.harga" type="number" id="harga"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-black" required />
                </div>
                <div class="mb-4">
                    <label for="idKereta" class="block text-sm font-medium text-black">IdKereta</label>
                    <input v-model="formData.id_kereta" type="text" id="kereta"
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
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Asal Keberangkatan</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Tujuan Keberangkatan</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Keberangkatan</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Kedatangan</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Harga</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">idKereta</th>
                    <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="jadwalItem in jadwal" :key="jadwalItem.id"
                    class="border-t border-gray-200 dark:border-gray-700">
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <input type="checkbox" v-model="selectedItems" :value="jadwalItem.id"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    </td>
                    <td class="py-2 px-4">{{ jadwalItem.id }}</td>
                    <td class="py-2 px-4">{{ jadwalItem.asal_keberangkatan }}</td>
                    <td class="py-2 px-4">{{ jadwalItem.tujuan_keberangkatan }}</td>
                    <td class="py-2 px-4">{{ jadwalItem.keberangkatan }}</td>
                    <td class="py-2 px-4">{{ jadwalItem.kedatangan }}</td>
                    <td class="py-2 px-4">{{ jadwalItem.harga }}</td>
                    <td class="py-2 px-4">{{ jadwalItem.id_kereta }}</td>
                    <td class="py-2 px-4">
                        <button @click="showModal('edit', jadwalItem)"
                            class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">
                            Edit
                        </button>
                        <!-- <button @click="confirmDelete(jadwalItem.id)"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-1">
                            Delete</button> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-if="isDeleteModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4 text-black">Confirm Deletion</h2>
            <p class="mb-4 text-black">Are you sure you want to delete the selected permohonan?</p>
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
        const jadwal = ref([]);
        const selectedItems = ref([]);
        const isModalOpen = ref(false);
        const modalType = ref('add');
        const formData = ref({ asal_keberangkatan: '', tujuan_keberangkatan: '', keberangkatan: '', kedatangan: '', harga: '', id_kereta: '' });
        const isDeleteModalOpen = ref(false);
        const itemIdToDelete = ref(null);

        const fetchJadwal = async () => {
            try {
                const response = await axios.get('/api/jadwal');
                jadwal.value = response.data;
            } catch (error) {
                console.error('Error fetching jadwal:', error);
            }
        };

        const showModal = (type, data = null) => {
            modalType.value = type;
            if (type === 'edit' && data) {
                formData.value = { ...data };
            } else {
                formData.value = { asal_keberangkatan: '', tujuan_keberangkatan: '', keberangkatan: '', kedatangan: '', harga: '', id_kereta: '' };
            }
            isModalOpen.value = true;
        };

        const handleSubmit = async () => {
            try {
                if (modalType.value === 'add') {
                    await axios.post('/api/jadwal', formData.value);
                } else {
                    await axios.put(`/api/jadwal/${formData.value.id}`, formData.value);
                }
                fetchJadwal();
                isModalOpen.value = false;
            } catch (error) {
                console.error('Error saving jadwal:', error);
            }
        };

        const toggleSelectAll = () => {
            if (selectedItems.value.length === jadwal.value.length) {
                selectedItems.value = [];
            } else {
                selectedItems.value = jadwal.value.map(jadwal => jadwal.id);
            }
        };

        const confirmDelete = (id = null) => {
            itemIdToDelete.value = id;
            isDeleteModalOpen.value = true;
        };

        const handleDelete = async () => {
            try {
                await axios.delete(`/api/jadwal/${itemIdToDelete.value}`);
                await fetchJadwal();
                isDeleteModalOpen.value = false;
            } catch (error) {
                console.error('Error deleting data:', error);
            }
        };

        const confirmDeleteMultiple = async () => {
            try {
                await Promise.all(selectedItems.value.map(id => axios.delete(`/api/jadwal/${id}`)));
                await fetchJadwal();
                selectedItems.value = [];
                isDeleteModalOpen.value = false;
            } catch (error) {
                console.error('Error deleting multiple:', error);
            }
        };

        onMounted(fetchJadwal);

        return {
            jadwal,
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
