<template>
  <div class="min-h-screen bg-gray-100">
      <Menu />
  </div>


  <!-- <div class="border-b">
    <nav class="max-w-7xl mx-auto flex justify-between items-center py-4 px-4">
      <Link :href="route('home')" class="text-cyan-600 text-xl font-semibold">MedList</Link>
      <div class="flex gap-4 items-center text-gray-500 ">
        <Link :href="route('login')" class="hover:text-gray-600">Login</Link>
        <Link :href="route('register')" class="hover:text-gray-600">Register</Link>
      </div>
    </nav>
  </div> -->

  <Header />

  <div class="max-w-7xl mx-auto px-4 h-screen py-8">
    <slot />
  </div>

  <Footer />
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '@/Parts/Header.vue';
import Footer from '@/Parts/Footer.vue';
import Menu from '@/Parts/Menu.vue';
</script>
