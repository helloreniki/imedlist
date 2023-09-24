<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { format, parseISO } from 'date-fns'
import { onMounted, ref, watch } from "vue";
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
// import { usePage } from '@inertiajs/vue3';
// const patients = usePage().props.patients

// accept props from laravel controller: updated_at is a string -> covert it with parseISO (could have changed it to date in controller also)
const props = defineProps({ patients: Object })

const showPatientModal = ref(false)
const selectedPatient = ref(null)

function openPatientData(patient) {
  selectedPatient.value = patient
  showPatientModal.value = true
}

const selectedDrug = ref(false)
const showDrugCreateForm = ref(false)

const patientModal = ref(null)
const drugModal = ref(null)


watch(patientModal, (newVal) => {
  if(newVal){
    newVal.focus()
  }
})

watch(drugModal, (newVal) => {
  if(newVal){
    newVal.focus()
  }
})

function focusOnFirstModal() {
  patientModal.value.focus()
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
                  <div v-for="(patient, i) in props.patients" :key="patient.id" class="max-w-fit mx-auto">
                    <div class="grid grid-cols-8 items-center leading-loose px-4 py-1" :class="[i%2 == 0 ? 'bg-gray-50' : 'bg-white']">
                      <div @click="openPatientData(patient)" class="flex gap-2 px-2 col-span-3 cursor-pointer">
                        <div>{{ patient.last_name }}</div>
                        <div>{{ patient.first_name }}</div>
                      </div>
                      <div class="flex gap-6 text-sm px-2 col-span-2">
                        <div @click="openPatientData(patient)" class="cursor-pointer">Show</div>
                        <div>Edit</div>
                      </div>
                      <div class="px-2 col-span-2 text-sm text-gray-500">{{ format(parseISO(patient.updated_at), 'dd/MM/yyyy' )}}</div>
                      <div class="text-right px-2 text-sm">Delete</div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- Modal Show Patient Data -->
        <Modal :show="showPatientModal" @close="showPatientModal = null">
          <div ref="patientModal" tabindex="0" class="p-6 flex flex-col gap-2">
            <div class="flex gap-2 text-semibold text-xl">
              <div>{{ selectedPatient.first_name }}</div>
              <div>{{ selectedPatient.last_name }}</div>
            </div>
            <div>Date of Birth: {{ format(parseISO(selectedPatient.dob), 'dd.MM.yyyy') }}</div>
            <div>Health Insurance Number: {{ selectedPatient.health_insurance_number }}</div>
            <div>Address: {{ selectedPatient.address }}</div>
            <div>Phone Number: {{ selectedPatient.phone }}</div>
            <div>Ilnesses: {{ selectedPatient.illness }}</div>
            <div>Allergies: {{ selectedPatient.allergies }}</div>
            <div>Emergency Contact: {{ selectedPatient.emergency_contact }}</div>
            <div class="text-xl font-bold mt-4">Drugs</div>
            <PrimaryButton @click="showDrugCreateForm = true" type="button" class="self-start">Add New Drug</PrimaryButton>
            <div v-for="(drug, i) in selectedPatient.drugs" :key="drug.id">
              <div @click="selectedDrug = !selectedDrug">{{ i+1 }}. {{ drug.name }} {{ drug.concentration }}, <span class="text-sm text-gray-500">{{ drug.active_ingredient }}</span></div>
              <div v-show="selectedDrug" class="text-sm text-gray-600 px-4 flex gap-2">
                <div v-if="drug.dosage_custom">{{ drug.dosage_custom }}</div>
                <div v-if="drug.dosage_morning">Morning: {{ drug.dosage_morning }} {{ drug.unit }} | </div>
                <div v-if="drug.dosage_midday">Midday: {{ drug.dosage_midday }} {{ drug.unit }} | </div>
                <div v-if="drug.dosage_evening">Evening: {{ drug.dosage_evening }} {{ drug.unit }}</div>
              </div>
            </div>
          </div>
        </Modal>

        <Modal :show="showDrugCreateForm" @close="showDrugCreateForm = false; focusOnFirstModal()">
          <div ref="drugModal" tabindex="0" class="p-6">
            <h2 class="text-2xl font-bold">Add New Drug</h2>
            <input type="text">

          </div>
        </Modal>


    </AppLayout>
</template>
