<script setup>
import { ref, watch, toRefs } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({ patient: Object })
const { patient } = toRefs(props)

const emit = defineEmits(['patientUpdated'])

const form = useForm({
  first_name: patient.value.first_name,
  last_name: patient.value.last_name,
  dob: patient.value.dob,
  health_insurance_number: patient.value.health_insurance_number,
  address: patient.value.address,
  phone: patient.value.phone,
  illness: patient.value.illness,
  allergies: patient.value.allergies,
  emergency_contact: patient.value.emergency_contact,
});

function submitForm() {
  // console.log('submited')
  form.put(route('patient.update', patient.value), {
    onSuccess: () => {
      // console.log('success');
      emit('patientUpdated')
    }
  })
}



</script>

<template>
  <div ref="drugModal" tabindex="0" class="px-12 py-8">
    <h2 class="text-2xl font-bold mb-8">
      Update Patient {{ patient.first_name }}
    </h2>
    <form @submit.prevent="submitForm()" class="flex flex-col gap-2">
      <div class="flex flex-col gap-2 p-2">
        <div class="flex gap-4">
          <div class="w-full">
            <InputLabel value="First Name" />
            <TextInput v-model="form.first_name" />
            <InputError :message="form.errors.first_name" />
          </div>
          <div class="w-full">
            <InputLabel value="Last Name" />
            <TextInput v-model="form.last_name" />
            <InputError :message="form.errors.last_name" />
          </div>
          <div class="w-full">
            <InputLabel value="Date of Birth" />
            <TextInput v-model="form.dob" />
            <InputError :message="form.errors.dob" />
          </div>
        </div>
        <div class="flex gap-4">
          <div class="w-full">
            <InputLabel value="Health Insurance Number" />
            <TextInput v-model="form.health_insurance_number" />
            <InputError :message="form.errors.health_insurance_number" />
          </div>
          <div class="w-full">
            <InputLabel value="Phone" />
            <TextInput v-model="form.phone" />
            <InputError :message="form.errors.phone" />
          </div>
        </div>
        <div>
          <InputLabel value="Address" />
          <TextInput v-model="form.address" />
          <InputError :message="form.errors.address" />
        </div>

        <div>
          <InputLabel value="Illnesses" />
          <TextInput v-model="form.illness" />
          <InputError :message="form.errors.illness" />
        </div>
        <div>
          <InputLabel value="Allergies" />
          <TextInput v-model="form.allergies" />
          <InputError :message="form.errors.allergies" />
        </div>
      </div>
      <PrimaryButton class="self-start">Save Patient</PrimaryButton>
    </form>
  </div>
</template>
