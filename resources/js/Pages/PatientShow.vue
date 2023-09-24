<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import { format, parseISO } from 'date-fns';
import AppLayout from '@/Layouts/AppLayout.vue';
import DrugForm from '@/Parts/DrugForm.vue';
import Modal from '@/Components/Modal.vue';

defineProps({ patient: Object })

const selectedDrug = ref(false)

const showDrugCreateModal = ref(false)

</script>
<template>
  <AppLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ patient.first_name }} {{ patient.last_name }}
        </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-8 min-h-screen">
              <div class="p-6 flex flex-col gap-2">
                <div>Date of Birth: {{ format(parseISO(patient.dob), 'dd.MM.yyyy') }}</div>
                <div>Health Insurance Number: {{ patient.health_insurance_number }}</div>
                <div>Address: {{ patient.address }}</div>
                <div>Phone Number: {{ patient.phone }}</div>
                <div>Ilnesses: {{ patient.illness }}</div>
                <div>Allergies: {{ patient.allergies }}</div>
                <div>Emergency Contact: {{ patient.emergency_contact }}</div>
                <div class="text-xl font-bold mt-4">Drugs</div>
                <PrimaryButton @click="showDrugCreateModal = true" type="button" class="self-start">Add New Drug</PrimaryButton>
                <div v-for="(drug, i) in patient.drugs" :key="drug.id">
                  <div @click="selectedDrug = !selectedDrug">{{ i+1 }}. {{ drug.name }} {{ drug.concentration }}, <span class="text-sm text-gray-500">{{ drug.active_ingredient }}</span></div>
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
    {{ patient }}
    <Modal :show="showDrugCreateModal" @close="showDrugCreateModal = false">
        <DrugForm ref="drugModal" :patient="patient" />
    </Modal>
  </AppLayout>
</template>
