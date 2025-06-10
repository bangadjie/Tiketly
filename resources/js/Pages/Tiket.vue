<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Tiket
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Tiket
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-6">
            <div class="w-full max-w-7xl">
                <table
                    class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <thead class="bg-gray-200 dark:bg-gray-600">
                        <tr>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">ID</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Asal Keberangkatan</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Tujuan Keberangkatan</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Keberangkatan</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Kedatangan</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Harga</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">IdKereta</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="jadwalItem in jadwal" :key="jadwalItem.id"
                            class="border-t border-gray-200 dark:border-gray-700">
                            <td class="py-2 px-4 text-center text-white">{{ jadwalItem.id }}</td>
                            <td class="py-2 px-4 text-center text-white">{{ jadwalItem.asal_keberangkatan }}</td>
                            <td class="py-2 px-4 text-center text-white">{{ jadwalItem.tujuan_keberangkatan }}</td>
                            <td class="py-2 px-4 text-center text-white">{{ jadwalItem.keberangkatan }}</td>
                            <td class="py-2 px-4 text-center text-white">{{ jadwalItem.kedatangan }}</td>
                            <td class="py-2 px-4 text-center text-white">{{ jadwalItem.harga }}</td>
                            <td class="py-2 px-4 text-center text-white">{{ jadwalItem.id_kereta }}</td>
                            <td class="py-2 px-4 text-center text-white">
                                <button @click="showModal()"
                                    class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </AuthenticatedLayout>
</template>



<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const jadwal = ref([]);

const fetchJadwal = async () => {
    try {
        const response = await axios.get('/api/jadwal');
        console.log("Response Data:", response.data);
        if (Array.isArray(response.data)) {
            jadwal.value = response.data;
        } else {
            console.error("Data yang diterima bukan array!", response.data);
        }
    } catch (error) {
        console.error('Error fetching jadwal:', error);
    }
}

onMounted(fetchJadwal);
</script>
