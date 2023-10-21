<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import PatientCreate from '@/Pages/Patient/PatientCreate.vue';
import PatientEdit from './Patient/PatientEdit.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Link, router } from '@inertiajs/vue3'
import { format, parseISO } from 'date-fns'
import { ref } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import { ChevronDownIcon } from '@heroicons/vue/24/solid';
import { ChevronUpIcon } from '@heroicons/vue/24/solid';

// import { usePage } from '@inertiajs/vue3';
// const patients = usePage().props.patients

// accept props from laravel controller: updated_at is a string -> covert it with parseISO (could have changed it to date in controller also)
const props = defineProps({ patients: Object })

const showPatientCreateModal = ref(false)
const showPatientEditModal = ref(false)
const showPatientDeleteModal = ref(false)

const patientToEdit = ref(null)
const patientToDelete = ref(null)

function editPatient(patient) {
  showPatientEditModal.value = true
  patientToEdit.value = patient
  console.log(patientToEdit.value)
}

function openDeleteModal(patient) {
  showPatientDeleteModal.value = true
  patientToDelete.value = patient
}

function deletePatient() {
  router.delete(route('patient.destroy', patientToDelete.value), {
    onSuccess: () => {
      console.log('deleting')
      showPatientDeleteModal.value = false
    }
  })
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
                  <div class="text-xl font-semibold mb-8">Patients ({{ patients.length }})</div>
                  <PrimaryButton @click="showPatientCreateModal = true" type="button" class="mb-6">Add New Patient</PrimaryButton>
                  <div class="grid grid-cols-6 gap-2 md:grid-cols-8 px-4 py-1 font-semibold">
                    <div class="col-span-3 px-2 text-left flex gap-2 items-center">
                      <div>Name</div>
                      <ChevronDownIcon class="h-4 w-4" />
                      <ChevronUpIcon class="h-4 w-4" />
                    </div>
                    <div class="text-center">DOB</div>
                    <div class="md:col-span-2"></div>
                    <div class="hidden md:block px-2 text-center">Updated</div>
                  </div>
                  <div v-for="(patient, i) in props.patients" :key="patient.id" class="">
                    <div class="grid grid-cols-6 md:grid-cols-8 gap-2 items-center leading-loose px-4 py-1" :class="[i%2 == 0 ? 'bg-gray-50' : 'bg-white']">
                      <Link :href="route('patient.show', patient)" class="flex gap-2 px-2 col-span-3 cursor-pointer">
                        <div>{{ patient.last_name }}</div>
                        <div>{{ patient.first_name }}</div>
                      </Link>
                      <div class="text-sm text-center text-gray-500">{{ format(parseISO(patient.dob), 'dd.MM.yyyy') }}</div>
                      <div class="flex gap-6 text-sm px-2 md:col-span-2 items-center justify-center">
                        <Link :href="route('patient.show', patient)" class="hidden md:block cursor-pointer text-gray-600 hover:text-gray-900">Show</Link>
                        <SecondaryButton @click="editPatient(patient)" class="">Edit</SecondaryButton>
                      </div>
                      <div class="hidden md:block px-2 text-sm text-center text-gray-500">{{ format(parseISO(patient.updated_at), 'dd/MM/yyyy' )}}</div>
                      <DangerButton @click="openDeleteModal(patient)" class="">Delete</DangerButton>
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

        <Modal :show="showPatientDeleteModal" @close="showPatientDeleteModal = false">
          <div class="p-8">
            <div>Are you sure you want to delete {{ patientToDelete.first_name }} {{ patientToDelete.last_name}}?</div>
            <div class="mt-4">
              <SecondaryButton @click="showPatientDeleteModal = false; patientToDelete = null" class="mr-2">Cancel</SecondaryButton>
              <DangerButton @click="deletePatient(patientToDelete)">Delete</DangerButton>
            </div>
          </div>
        </Modal>


    </AppLayout>
</template>
