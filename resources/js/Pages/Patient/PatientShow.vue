<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, toRefs } from 'vue';
import { router, Link } from "@inertiajs/vue3";
import { format, parseISO } from 'date-fns';
import AppLayout from '@/Layouts/AppLayout.vue';
import DrugForm from '@/Pages/Drug/DrugForm.vue'
import DrugEditForm from '@/Pages/Drug/DrugEditForm.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({ patient: Object, units: Array, patients: Object })
const { patient, units, patients } = toRefs(props)

console.log(units.value)

const selectedDrug = ref(false)

const showDrugCreateModal = ref(false)
const showDrugDeleteModal = ref(false)
const showDrugEditModal = ref(false)

const drugToBeDeleted = ref(null)
const drugToBeEdited = ref(null)

function openDeleteModal(drug) {
  showDrugDeleteModal.value = true
  drugToBeDeleted.value = drug
}

function deleteDrug(drug) {
  // console.log(patient.value)
  // console.log(drug)
  // i dont have a form here ->
  // use router.delete to route: /patients/{patient}/drugs/{drug}, pass parameters to route, has to be array!
  router.delete(route('drug.destroy', [patient.value, drug]), {
    onSuccess: () => {
      console.log('deleting');
      showDrugDeleteModal.value = false
    }
  })
}

function openEditModal(drug){
  showDrugEditModal.value = true;
  drugToBeEdited.value = drug
}

</script>
<template>
  <AppLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ patient.first_name }} {{ patient.last_name }}
          </h2>
          <div class="flex gap-2">
            <div>Date of Birth: </div>
            <div v-if="patient.dob">{{ format(parseISO(patient.dob), 'dd.MM.yyyy') }}</div>
          </div>
          <div>Address: {{ patient.address }}</div>
          <div>Phone Number: {{ patient.phone }}</div>
          <div>Health Insurance Number: {{ patient.health_insurance_number }}</div>
          <div>Ilnesses: {{ patient.illness }}</div>
          <div>Allergies: {{ patient.allergies }}</div>
          <div>Emergency Contact: {{ patient.emergency_contact }}</div>
    </template>
    <div class="py-12">
      <div class="flex gap-4 max-w-[1500px]  mx-auto sm:px-6 lg:px-8">
          <div class="flex flex-col gap-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-4 min-h-screen min-w-fit">
            <Link :href="route('patient.show', patient)" v-for="patient in patients" :key="patient.id" class="hover:text-cyan-600" :class="{'text-cyan-600 font-semibold': $page.url == '/patients/' + patient.id }">{{ patient.first_name }} {{ patient.last_name }}</Link>
          </div>
          <div class="w-full bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-4 min-h-screen">
              <div class="p-6 flex flex-col gap-2">
                <div class="text-3xl font-bold mb-4">Drugs</div>
                <PrimaryButton @click="showDrugCreateModal = true" type="button" class="self-start mb-4">Add New Drug</PrimaryButton>
                <div v-for="(drug, i) in patient.drugs" :key="drug.id" class="max-w-xl">
                  <div class="flex justify-between items-center font-semibold px-4 py-1 uppercase border rounded-lg shadow-md border-gray-300">
                    <div @click="selectedDrug = !selectedDrug" class="flex gap-2 cursor-pointer">
                      <div class="font-normal mr-2">{{ i+1 }}.</div>
                      <div>{{ drug.name }} {{ drug.concentration }},</div>
                      <div class="text-sm text-gray-500 normal-case">{{ drug.active_ingredient }}</div>
                    </div>

                    <div class="">
                      <SecondaryButton @click="openEditModal(drug)" class="mr-2">Edit</SecondaryButton>
                      <DangerButton @click="openDeleteModal(drug)">Delete</DangerButton>
                    </div>
                  </div>
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

    <Modal :show="showDrugDeleteModal" @close="showDrugDeleteModal = false">
      <div class="p-8">
        <div>Are you sure you want to delete {{ drugToBeDeleted.name }}?</div>
        <div>
          <SecondaryButton @click="showDrugDeleteModal = false; drugToBeDeleted = null" class="mr-2">Cancel</SecondaryButton>
          <DangerButton @click="deleteDrug(drugToBeDeleted)">Delete</DangerButton>
        </div>
      </div>
    </Modal>

    <Modal :show="showDrugEditModal" @close="showDrugEditModal = false">
      <DrugEditForm :patient="patient" :drug="drugToBeEdited" :units="units" @closeModal="showDrugEditModal = false" />
    </Modal>
  </AppLayout>
</template>
