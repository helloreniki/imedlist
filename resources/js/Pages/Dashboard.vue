<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import PatientCreate from '@/Pages/Patient/PatientCreate.vue';
import PatientEdit from './Patient/PatientEdit.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Link, router } from '@inertiajs/vue3'
import { format, parseISO } from 'date-fns'
import { ref, watch, computed } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import { ChevronDownIcon } from '@heroicons/vue/24/solid';
import { ChevronUpIcon } from '@heroicons/vue/24/solid';
import TextInput from '@/Components/TextInput.vue';
import VueTailwindDatepicker from "vue-tailwind-datepicker";

// import { usePage } from '@inertiajs/vue3';
// const patients = usePage().props.patients

// accept props from laravel controller: updated_at is a string -> covert it with parseISO (could have changed it to date in controller also)
const props = defineProps({ patients: Array })

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

// sorting + search + date

const sortDirection = ref('desc')
const sortColumn = ref('updated_at')
const searchInput = ref('')
const dateValue = ref({
  startDate: "",
  endDate: "",
});
const formatter = ref({
  date: 'YYYY-MM-DD',
  month: 'MM',
})

const sortedPatients = computed(() => {
  return Object.values(props.patients)
    .filter(patient =>
          patient.last_name.toLowerCase().includes(searchInput.value.toLowerCase())
          || patient.first_name.toLowerCase().includes(searchInput.value.toLowerCase())
    )
    .filter(patient => {
      if(dateValue.value.startDate && dateValue.value.endDate){
        return new Date(patient.updated_at) >= new Date(dateValue.value.startDate) && new Date(patient.updated_at).setHours(0,0,0,0) <= new Date(dateValue.value.endDate);
      } else {
        return patient;
      }
    })
    .sort((a,b) => {
      if(sortDirection.value == 'asc'){
        if(a[sortColumn.value] > b[sortColumn.value]){
          return 1;
        } else {
          return -1;
        }
      } else {
        if(a[sortColumn.value] > b[sortColumn.value]){
          return -1;
        } else {
          return 1;
        }
      }
  })
})

// watch(sortedPatients, (newVal) => {
//   console.log('watch', sortedPatients.value.length)
//   console.log(sortDirection.value)
//   console.log(sortColumn.value)
// })


// startDate, endDate is a string '03.10.2023'
// watch(() => dateValue, (newVal) => {
//   console.log('watch date', newVal.value.startDate)
//   console.log('watch date', new Date(newVal.value.startDate)) // careful, string date has to be in format YYYY-MM-DD

// }, { deep: true })

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
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 sm:px-8 py-8 min-h-screen">
                  <div class="text-xl font-semibold mb-8">Patients ({{ sortedPatients.length }})</div>
                  <div class="flex flex-col sm:flex-row gap-4 sm:items-center mb-6 max-w-sm sm:max-w-none">
                    <PrimaryButton @click="showPatientCreateModal = true" type="button" class="shrink-0 self-start">Add New Patient</PrimaryButton>
                    <vue-tailwind-datepicker v-model="dateValue" :formatter="formatter" as-single use-range class="" />
                    <TextInput type="text" placeholder="Search..." v-model="searchInput" class="" />
                  </div>
                  <div class="grid grid-cols-6 gap-2 md:grid-cols-8 px-2 sm:px-4 py-1 font-semibold">
                    <div class="col-span-3 px-2 text-left flex gap-2 items-center">
                      <div>Name</div>
                      <ChevronDownIcon @click="sortDirection = 'asc'; sortColumn = 'last_name'" class="h-4 w-4" />
                      <ChevronUpIcon  @click="sortDirection = 'desc'; sortColumn = 'last_name'" class="h-4 w-4" />
                    </div>
                    <div class="text-center">DOB</div>
                    <div class="md:col-span-2"></div>
                    <div class="hidden md:flex gap-2 items-center px-2">
                      <div>Updated</div>
                      <ChevronDownIcon @click="sortDirection = 'asc'; sortColumn = 'updated_at'" class="h-4 w-4" />
                      <ChevronUpIcon @click="sortDirection = 'desc'; sortColumn = 'updated_at'" class="h-4 w-4" />
                    </div>
                  </div>
                  <div v-if="sortedPatients.length == 0" class="px-6 py-4">No patients...</div>
                  <div v-for="(patient, i) in sortedPatients" :key="patient.id" class="">
                    <div class="grid grid-cols-6 md:grid-cols-8 gap-2 items-center leading-loose px-4 py-1" :class="[i%2 == 0 ? 'bg-gray-50' : 'bg-white']">
                      <Link :href="route('patient.show', patient)" class="flex gap-2 px-2 col-span-3 cursor-pointer">
                        <div>{{ patient.last_name }}</div>
                        <div>{{ patient.first_name }}</div>
                      </Link>
                      <div class="text-sm text-center text-gray-500">{{ format(parseISO(patient.dob), 'dd.MM.yyyy') }}</div>
                      <div class="flex gap-6 text-sm px-2 md:col-span-2 items-center justify-center">
                        <Link :href="route('patient.show', patient)" class="hidden md:block cursor-pointer text-gray-600 hover:text-gray-900">Show</Link>
                        <SecondaryButton @click="editPatient(patient)" class="">
                          <p class="sm:hidden">E</p>
                          <p class="hidden sm:block">Edit</p>
                        </SecondaryButton>
                      </div>
                      <div class="hidden md:block px-2 text-sm text-gray-500">{{ format(parseISO(patient.updated_at), 'dd/MM/yyyy' )}}</div>
                      <DangerButton @click="openDeleteModal(patient)" class="">
                        <p class="sm:hidden">Del</p>
                        <p class="hidden sm:block">Delete</p>
                      </DangerButton>
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
