<template>
   <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
  <!-- First Section -->
  <div class="md:flex">
    <div class="md:flex-shrink-0">
      <img class="h-48 w-full object-cover md:w-48" src="https://via.placeholder.com/150" alt="Placeholder">
    </div>
    <div class="p-8">
      <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Section 1</div>
      <h2 class="mt-2 text-2xl leading-7 font-bold text-gray-900 sm:text-3xl sm:truncate">Title</h2>
      <button class="mt-4 bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Button</button>
    </div>
  </div>

  <!-- Second Section -->
  <div class="p-8">
    <p class="text-gray-700">All your text content goes here.</p>
  </div>

  <!-- Third Section -->
  <div class="p-8">
    <div class="flex items-center">
      <div class="w-32">Price:</div>
      <div class="text-gray-700">1000</div>
    </div>
  </div>
</div>

</template>

<script>
export default {
name: 'CardComponent',
mounted() {}
}
</script>

<style scoped>
</style>
