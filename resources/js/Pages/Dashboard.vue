<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
// import { usePage } from '@inertiajs/vue3';
// const patients = usePage().props.patients
// accept props from laravel controller:
const props = defineProps({ patients: Object })


</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-8 min-h-screen">
                  <div class="text-xl font-semibold mb-8">Patients</div>
                  <div v-for="(patient, i) in props.patients" :key="patient.id" class="max-w-fit mx-auto">
                    <div class="grid grid-cols-8 items-center leading-loose px-4 py-1" :class="[i%2 == 0 ? 'bg-gray-50' : 'bg-white']">
                      <div class="flex gap-2 px-2 col-span-3">
                        <div>{{ patient.last_name }}</div>
                        <div>{{ patient.first_name }}</div>
                      </div>
                      <div class="flex gap-6 text-sm px-2 col-span-2">
                        <div>Show</div>
                        <div>Edit</div>
                      </div>
                      <div class="px-2 col-span-2">{{ patient.updated_at }}</div>
                      <div class="text-right px-2 text-sm">Delete</div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
