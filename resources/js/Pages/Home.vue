<template>
  <GuestLayout>

      <ul class="mt-8 text-2xl flex flex-col gap-4">
        <li v-for="list in lists" class="">
          <div class="flex gap-3 items-center">
            <ArrowRightCircleIcon class="w-6 h-6 text-indigo-600"/>
            <div class="font-semibold"> {{ list.title }} </div>
          </div>
          <ul v-if="list.sublist" class="list-disc list-inside marker:text-indigo-600 ml-16">
            <li v-for="sub in list.sublist">{{ sub }}</li>
          </ul>
        </li>



<!--

        <li>Create a patient with all important information:
          <ul class="list-disc list-inside flex flex-col gap-2 ml-12">
            <li>name</li>
            <li>address</li>
            <li>health insurance number</li>
            <li>phone number</li>
            <li>emergency contact</li>
            <li>allergies</li>
            <li>diseases</li>
          </ul>
        </li>
        <li>Attach drugs to a patient</li>
        <li>For each drug include information about drug:</li>
          <ul class="flex flex-col gap-2 list-disc list-inside ml-12">
            <li>drug name</li>
            <li>concentration</li>
            <li>active ingredient</li>
            <li>dosage: custom, morning, midday, evening</li>
          </ul>
        <li>Save a patient with his drugs information</li>
        <li>You can export data to PDF and print it, so you can always have it in your wallet</li>
        <li>If anything changes, you can later easily change and update any information</li> -->
      </ul>

  </GuestLayout>


</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { ArrowRightCircleIcon } from '@heroicons/vue/24/solid';

const lists = [
  { id: 1, title: 'Create a patient with all important information:', sublist: ['name', 'address', 'health insurance number', 'phone number','emergency contact', 'allergies', 'diseases'] },
  { id: 2, title: 'Attach drugs to a patient'},
  { id: 3, title: 'For each drug include information about drug:', sublist: ['drug name', 'concentraction', 'active ingredient', 'dosage: custom, morning, midday, evening', 'unit: tablet, ml, drops,...']},
  { id: 4, title: 'Save a patient with his drugs information'},
  { id: 5, title: 'You can export data to PDF and print it, so you can always have it in your wallet'},
  { id: 6, title: 'Or access it online from wherever you are'},
  { id: 7, title: 'If anything changes, you can later easily change and update any information'},
]

</script>
