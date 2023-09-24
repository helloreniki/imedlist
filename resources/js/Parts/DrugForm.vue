<script setup>
import { ref, watch } from 'vue';
import InputLabel from '@/components/InputLabel.vue'
import InputError from '@/components/InputError.vue'
import TextInput from '@/components/TextInput.vue'
import { useForm } from '@inertiajs/vue3'
import DrugInput from '@/Parts/DrugInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({ patient: Object })

// console.log(patient)

// const drugModal = ref(null)

// watch(drugModal, (newVal) => {
//   if(newVal){
//     newVal.focus()
//   }
// })

// const form = useForm({
//   name: null,
//   concentration: null,
//   active_ingredient: null,
//   dosage_custom: null,
//   dosage_morning: null,
//   dosage_midday: null,
//   dosage_evening: null,
// })

// const dosage_type = ref('Custom Dosage')

function submitForm() {
  console.log('submited')
  form.post(route(patient-drugs.store), {
    onSuccess: () => {console.log('success')}
  })
}


</script>

<template>
  <div ref="drugModal" tabindex="0" class="px-12 py-8">
    <h2 class="text-2xl font-bold mb-8">Add New Drug for {{ patient.first_name }} {{ patient.last_name }}</h2>
    <form @submit.prevent="submitForm()" class="flex flex-col gap-2">
     <DrugInput />
     <PrimaryButton type="button" class="self-start">Save Drug</PrimaryButton>
    </form>

  </div>
</template>
