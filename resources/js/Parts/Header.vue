<template>
<header class="bg-white shadow-md bg-gradient-to-br from-white to-indigo-100">
  <div class="max-w-7xl mx-auto px-4 py-28 ">
    <!-- <h1 class="text-8xl font-black text-indigo-800">MedList</h1> -->
    <h1 class="text-7xl mt-8 max-w-4xl text-gray-800 font-black leading-none">Free <span class="text-indigo-700 font-black">printable</span> and <span class="text-indigo-700 font-black">online</span> medication list</h1>
    <p class="text-3xl mt-4 mb-10">Create a list of medications for you or someone close to you, export it to PDF and print or just access it online.</p>
    <div class="text-2xl">
      <a :href="route('register')" class="bg-indigo-700 hover:bg-indigo-800 text-white px-4 py-2 rounded-md">Sign in for free</a>
      <span class="mx-4">or</span>
      <a :href="route('login')" class="bg-indigo-700 hover:bg-indigo-800 text-white px-4 py-2 rounded-md">Log in</a>

    </div>
  </div>
</header>
</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>
