<script setup>
import { ref, watch, toRefs } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const emit = defineEmits(['patientCreated'])

const form = useForm({
  first_name: null,
  last_name: null,
  dob: null,
  health_insurance_number: null,
  address: null,
  phone: null,
  illness: null,
  allergies: null,
  emergency_contact: null,
});

function submitForm() {
  // console.log('submited')
  form.post(route('patient.store'), {
    onSuccess: () => {
      // console.log('success');
      emit('patientCreated')
    }
  })
}



</script>

<template>
  <div ref="drugModal" tabindex="0" class="px-2 sm:px-4 md:px-12 py-8">
    <h2 class="text-2xl font-bold mb-8">
      Add New Patient
    </h2>
    <form @submit.prevent="submitForm()" class="flex flex-col gap-2">
      <div class="flex flex-col gap-2 p-2">
        <div class="flex flex-col md:flex-row gap-4">
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
            <!-- todo: datepicker -->
            <InputLabel value="Date of Birth" />
            <TextInput v-model="form.dob" />
            <InputError :message="form.errors.dob" />
          </div>
        </div>
        <div class="flex flex-col sm:flex-row gap-4">
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
