<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, toRefs } from 'vue';
import { format, parseISO } from 'date-fns';
import AppLayout from '@/Layouts/AppLayout.vue';
import DrugForm from '@/Parts/DrugForm.vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({ patient: Object, units: Array })
const { patient, units } = toRefs(props)

console.log(units.value)

const selectedDrug = ref(false)

const showDrugCreateModal = ref(false)

</script>
<template>
  <AppLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ patient.first_name }} {{ patient.last_name }}
          </h2>
          <div>Date of Birth: {{ format(parseISO(patient.dob), 'dd.MM.yyyy') }}</div>
          <div>Address: {{ patient.address }}</div>
          <div>Phone Number: {{ patient.phone }}</div>
          <div>Health Insurance Number: {{ patient.health_insurance_number }}</div>
          <div>Ilnesses: {{ patient.illness }}</div>
          <div>Allergies: {{ patient.allergies }}</div>
          <div>Emergency Contact: {{ patient.emergency_contact }}</div>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-4 min-h-screen">
              <div class="p-6 flex flex-col gap-2">
                <div class="text-3xl font-bold mb-4">Drugs</div>
                <PrimaryButton @click="showDrugCreateModal = true" type="button" class="self-start mb-4">Add New Drug</PrimaryButton>
                <div v-for="(drug, i) in patient.drugs" :key="drug.id" class="max-w-xl">
                  <div @click="selectedDrug = !selectedDrug" class="font-semibold px-4 py-1 uppercase border rounded-lg shadow-md border-gray-300 cursor-pointer"><span class="font-normal mr-2">{{ i+1 }}.</span>{{ drug.name }} {{ drug.concentration }}, <span class="text-sm text-gray-500 normal-case">{{ drug.active_ingredient }}</span></div>
                  <div v-show="selectedDrug" class="text-sm text-gray-600 px-4 flex gap-2">
                    <div v-if="drug.dosage_custom">{{ drug.dosage_custom }}</div>
                    <div v-if="drug.dosage_morning">Morning: {{ drug.dosage_morning }} {{ drug.unit }} | </div>
                    <div v-if="drug.dosage_midday">Midday: {{ drug.dosage_midday }} {{ drug.unit }} | </div>
                    <div v-if="drug.dosage_evening">Evening: {{ drug.dosage_evening }} {{ drug.unit }}</div>
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>
    <Modal :show="showDrugCreateModal" @close="showDrugCreateModal = false">
        <DrugForm :patient="patient" :units="units" @closeModal="showDrugCreateModal = false" />
    </Modal>
  </AppLayout>
</template>
