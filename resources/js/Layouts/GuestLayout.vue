<template>
  <div class="">
    <Menu />
    <Header />

    <div class="max-w-7xl mx-auto px-4 min-h-screen py-16">
      <slot />
    </div>

    <Footer />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '@/Parts/Header.vue';
import Footer from '@/Parts/Footer.vue';
import Menu from '@/Parts/Menu.vue';
</script>
