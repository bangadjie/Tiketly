<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                History
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
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Tanggal Pembelian</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Pelanggan</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Jadwal</th>
                            <th class="py-2 px-4 text-center text-sm font-medium text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="Item in pembayaran" :key="Item.id"
                            class="border-t border-gray-200 dark:border-gray-700">
                            <td class="py-2 px-4 text-center text-white">{{ Item.id }}</td>
                            <td class="py-2 px-4 text-center text-white">{{ Item.tanggal_pembelian }}</td>
                            <td class="py-2 px-4 text-center text-white">{{ Item.id_pelanggan }}</td>
                            <td class="py-2 px-4 text-center text-white">{{ Item.id_jadwal }}</td>
                            <td class="py-2 px-4 text-center text-white">
                                <button @click="showModalFunc(Item.id)"
                                    class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">
                                    Bayar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Konfirmasi Pembayaran</h3>
                <div v-if="selectedDetail" class="space-y-2 text-gray-700 dark:text-gray-300">
                    <p><strong>NIK:</strong> {{ selectedDetail.NIK }}</p>
                    <p><strong>ID Gerbong:</strong> {{ selectedDetail.id_gerbong }}</p>
                    <p><strong>ID Kursi:</strong> {{ selectedDetail.id_kursi }}</p>
                    <label for="metode_pembayaran"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Metode
                        Pembayaran</label>
                    <select id="metode_pembayaran" v-model="selectedMetode"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500 dark:bg-gray-800 dark:text-white">
                        <option disabled value="">-- Pilih Metode --</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="E-Wallet">E-Wallet</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                        <option value="QRIS">QRIS</option>
                        <option value="CASH">CASH</option>
                    </select>
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <button @click="showModal = false"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Batal</button>
                    <button @click="submitBayar"
                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded">Bayar</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const detail = ref([]);
const pembayaran = ref([]);
const showModal = ref(false);
const selectedDetail = ref(null);
const selectedPembayaranId = ref(null);
const selectedMetode = ref('');  // Menambahkan inisialisasi untuk selectedMetode

const fetchPembayaran = async () => {
    try {
        const response = await axios.get('/api/pembayaran');
        pembayaran.value = response.data;
    } catch (error) {
        console.error('Gagal ambil data pembayaran:', error);
    }
};

const fetchDetail = async () => {
    try {
        const response = await axios.get('/api/detail');
        detail.value = response.data;
    } catch (error) {
        console.error('Gagal ambil data detail:', error);
    }
};

const showModalFunc = (idPembayaran) => {
    selectedPembayaranId.value = idPembayaran;
    selectedDetail.value = detail.value.find(d => d.id_pembelian_tiket == idPembayaran);

    if (!selectedDetail.value) {
        alert('Data detail tidak ditemukan!');
        return;
    }

    showModal.value = true;
};

const submitBayar = async () => {
    if (!selectedMetode.value) {
        alert('Pilih metode pembayaran dulu yaa 😗');
        return;
    }

    try {
        console.log(selectedDetail.value);  // Pastikan data yang dikirim sudah sesuai
        await axios.post('/api/detail', {
            NIK: String(selectedDetail.value.NIK),
            id_pembelian_tiket: String(selectedDetail.value.id_pembelian_tiket),  // Perbaikan penggunaan id_pembelian_tiket
            id_gerbong: selectedDetail.value.id_gerbong,
            id_kursi: selectedDetail.value.id_kursi,
            metode_pembayaran: selectedMetode.value,
        });

        alert('Pembayaran berhasil disimpan 💕');
        showModal.value = false;
        fetchDetail(); // refresh data detail setelah disimpan
    } catch (error) {
        console.error(error);
        alert('Gagal menyimpan detail pembayaran 😢');
    }
};

onMounted(() => {
    fetchPembayaran();
    fetchDetail();
});
</script>
