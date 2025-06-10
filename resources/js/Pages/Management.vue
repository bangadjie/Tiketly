<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UserTable from '@/Components/TableUser.vue';
import TableUser from '@/Components/TableUser.vue';
import TableKereta from '@/Components/TableKereta.vue';
import TableGerbong from '@/Components/TableGerbong.vue';
import TableKursi from '@/Components/TableKursi.vue';
import Jadwal from '@/Components/Jadwal.vue';
import TablePetugas from '@/Components/TablePetugas.vue';
import TablePelanggan from '@/Components/TablePelanggan.vue';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Management
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Management
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-900 dark:text-gray-100">
                        <div>
                            <TableUser />
                        </div>
                        <!-- <div>
                            <TableKereta />
                        </div>
                        <div>
                            <TableGerbong />
                        </div>
                        <div>
                            <TableKursi />
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <Jadwal />
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <TablePetugas />
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <TablePelanggan />
                    </div>
                </div>
            </div>
        </div> -->
    </AuthenticatedLayout>
</template>
