<script setup>
import { ref, watch, toRefs } from 'vue';
import InputLabel from '@/components/InputLabel.vue'
import InputError from '@/components/InputError.vue'
import TextInput from '@/components/TextInput.vue'
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({ patient: Object, units: Array })
const { patient, units } = toRefs(props)
const emit = defineEmits(['closeModal'])

const form = useForm({
  name: null,
  concentration: null,
  active_ingredient: null,
  dosage_custom: null,
  dosage_morning: null,
  dosage_midday: null,
  dosage_evening: null,
})

// patient_id from route model binding

const dosage_type = ref('Custom Dosage')

// console.log(pacient.value)
function submitForm() {
  console.log('submited')
  console.log(patient)
  form.post(route('drug.store', patient.value), {
    onSuccess: () => {
      // console.log('success');
      emit('closeModal')
    }
  })
}



</script>

<template>
  <div ref="drugModal" tabindex="0" class="px-12 py-8">
    <h2 class="text-2xl font-bold mb-8">Add New Drug for {{ patient.first_name }} {{ patient.last_name }}</h2>
    <form @submit.prevent="submitForm()" class="flex flex-col gap-2">
      <div class="flex flex-col gap-2 bg-gray-50 p-2">
        <div class="flex gap-4 bg-gray-50">
          <div class="w-3/4">
            <InputLabel value="Drug Name" />
            <TextInput v-model="form.name" />
            <InputError :message="form.errors.name" />
          </div>
          <div class="1/4">
            <InputLabel value="Concentration" />
            <TextInput v-model="form.concentration" />
            <InputError :message="form.errors.concentration" />
          </div>
          <div>
            <InputLabel value="Active Ingredient" />
            <TextInput v-model="form.active_ingredient" />
            <InputError :message="form.errors.active_ingredient" />
          </div>
        </div>

        <div class="flex gap-4 my-2">
          <input type="radio" for="type1" name="dosage_type" v-model="dosage_type" value="Custom Dosage">
          <InputLabel for="type1">Custom Dosage</InputLabel>
          <input type="radio" for="type2" name="dosage_type" v-model="dosage_type" value="Specified Dosage">
          <InputLabel for="type2">Specified Dosage</InputLabel>

        </div>

        <div v-if="dosage_type == 'Custom Dosage'">
          <InputLabel value="Dosage Custom" />
          <TextInput v-model="form.dosage_custom" />
          <InputError :message="form.errors.dosage_custom" />
        </div>

        <div v-if="dosage_type == 'Specified Dosage'" class="flex gap-2 items-center">
          <div>
            <InputLabel value="Dosage Morning" />
            <TextInput v-model="form.dosage_morning" />
            <InputError :message="form.errors.dosage_morning" />
          </div>
          <div>
            <InputLabel value="Dosage Midday" />
            <TextInput v-model="form.dosage_midday" />
            <InputError :message="form.errors.dosage_midday" />
          </div>
          <div>
            <InputLabel value="Dosage Evening" />
            <TextInput v-model="form.dosage_evening" />
            <InputError :message="form.errors.dosage_evening" />
          </div>
          <div>
            <InputLabel>Choose a unit</InputLabel>
            <select id="unit" class="text-sm shadow-sm border-gray-300 ring-0 focus:outline-none rounded-md ">
              <option :value="unit" v-for="(unit, i) in units" :key="i" class="text-sm">{{ unit }}</option>
            </select>
          </div>
        </div>
      </div>
     <PrimaryButton class="self-start">Save Drug</PrimaryButton>
    </form>
  </div>
</template>
