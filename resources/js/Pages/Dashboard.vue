<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import PatientCreate from '@/Pages/Patient/PatientCreate.vue';
import PatientEdit from './Patient/PatientEdit.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Link } from '@inertiajs/vue3'
import { format, parseISO } from 'date-fns'
import { ref } from 'vue';

// import { usePage } from '@inertiajs/vue3';
// const patients = usePage().props.patients

// accept props from laravel controller: updated_at is a string -> covert it with parseISO (could have changed it to date in controller also)
const props = defineProps({ patients: Object })

const showPatientCreateModal = ref(false)
const showPatientEditModal = ref(false)

const patientToEdit = ref(null)

function editPatient(patient) {
  showPatientEditModal.value = true
  patientToEdit.value = patient
  console.log(patientToEdit.value)
}
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
                  <PrimaryButton @click="showPatientCreateModal = true" type="button" class="mb-6">Add New Patient</PrimaryButton>
                  <div v-for="(patient, i) in props.patients" :key="patient.id" class="max-w-fit">
                    <div class="grid grid-cols-8 items-center leading-loose px-4 py-1" :class="[i%2 == 0 ? 'bg-gray-50' : 'bg-white']">
                      <Link :href="route('patient.show', patient)" class="flex gap-2 px-2 col-span-3 cursor-pointer">
                        <div>{{ patient.last_name }}</div>
                        <div>{{ patient.first_name }}</div>
                      </Link>
                      <div class="flex gap-6 text-sm px-2 col-span-2">
                        <Link :href="route('patient.show', patient)" class="cursor-pointer">Show</Link>
                        <SecondaryButton @click="editPatient(patient)">Edit</SecondaryButton>
                      </div>
                      <div class="px-2 col-span-2 text-sm text-gray-500">{{ format(parseISO(patient.updated_at), 'dd/MM/yyyy' )}}</div>
                      <div class="text-right px-2 text-sm">Delete</div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <Modal :show="showPatientCreateModal" @close="showPatientCreateModal = false">
          <PatientCreate @patient-created="showPatientCreateModal = false"/>
        </Modal>

        <Modal :show="showPatientEditModal" @close="showPatientEditModal = false">
          <PatientEdit :patient="patientToEdit" @patient-updated="showPatientEditModal = false" />
        </Modal>


    </AppLayout>
</template>
