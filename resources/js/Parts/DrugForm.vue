<script setup>
import { ref, watch } from 'vue';

const drugModal = ref(null)

watch(drugModal, (newVal) => {
  if(newVal){
    newVal.focus()
  }
})
</script>

<template>
  <div ref="drugModal" tabindex="0" class="p-6">
    <h2 class="text-2xl font-bold">Add New Drug</h2>
    <input type="text">

  </div>
</template>
