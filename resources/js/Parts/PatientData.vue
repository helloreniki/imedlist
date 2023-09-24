<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { format, parseISO } from 'date-fns';
import { ref, watch, toRefs } from 'vue';

const props = defineProps({ patient: Object, isFocused: Boolean })
// props are reactive, but not if u desctructure it, loses reactivity

const { patient, isFocused } = toRefs(props)


const selectedDrug = ref(false)
const patientModal = ref(null) // template ref


watch(patientModal, (newVal) => {
  if(newVal){
    newVal.focus()
  }
})

watch(isFocused, (newVal) => {
  console.log('watch')
  if(newVal == true){
    patientModal.value.focus()
  }
})


const emit = defineEmits(['openDrugModal'])

</script>
<template>
 <div ref="patientModal" tabindex="0" class="p-6 flex flex-col gap-2">
  {{ isFocused }}
  <div class="flex gap-2 text-semibold text-xl">
    <div>{{ patient.first_name }}</div>
    <div>{{ patient.last_name }}</div>
  </div>
  <div>Date of Birth: {{ format(parseISO(patient.dob), 'dd.MM.yyyy') }}</div>
  <div>Health Insurance Number: {{ patient.health_insurance_number }}</div>
  <div>Address: {{ patient.address }}</div>
  <div>Phone Number: {{ patient.phone }}</div>
  <div>Ilnesses: {{ patient.illness }}</div>
  <div>Allergies: {{ patient.allergies }}</div>
  <div>Emergency Contact: {{ patient.emergency_contact }}</div>
  <div class="text-xl font-bold mt-4">Drugs</div>
  <PrimaryButton @click="$emit('openDrugModal')" type="button" class="self-start">Add New Drug</PrimaryButton>
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
</template>
