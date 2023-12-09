<script setup>
import { ref, watch, toRefs } from 'vue';
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import TextInput from '@/Components/TextInput.vue'
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({ patient: Object, units: Array, drug: Object })
const { patient, units, drug } = toRefs(props)
const emit = defineEmits(['closeModal'])

const form = useForm({
  name: drug.value.name,
  concentration: drug.value.concentration,
  active_ingredient: drug.value.active_ingredient,
  dosage_custom: drug.value.dosage_custom,
  dosage_morning: drug.value.dosage_morning,
  dosage_midday: drug.value.dosage_midday,
  dosage_evening: drug.value.dosage_evening,
})

// patient_id from route model binding

const dosage_type = ref('Custom Dosage')

// console.log(pacient.value)
function submitForm() {
  console.log('submited')
  console.log(patient)
  form.put(route('drug.update', [patient.value, drug.value]), {
    onSuccess: () => {
      // console.log('success');
      emit('closeModal')
    }
  })
}

// add patient.value to route, accept in controller - route model binding
// could use different route: just /drugs/{drug}: have to send form with patient_id -> this would be better and simpler

</script>

<template>
  <div ref="drugModal" tabindex="0" class="px-12 py-8">
    <h2 class="text-2xl font-bold mb-8">Add New Drug for {{ patient.first_name }} {{ patient.last_name }}</h2>
    <form @submit.prevent="submitForm()" class="flex flex-col gap-2">
      <div class="flex flex-col gap-2 p-2">
        <div class="flex flex-col md:flex-row gap-x-4 gap-y-2">
          <div class="md:w-1/2">
            <InputLabel value="Drug Name" />
            <TextInput v-model="form.name" />
            <InputError :message="form.errors.name" />
          </div>
          <div class="">
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
