<!-- components/CardComponent.vue -->
<template>
    <div class="bg-white rounded-lg shadow-md p-4 mb-4">
      <div class="flex items-center">
        <div class="flex-initial w-80">
          <p>{{ segment.name }}</p>
        </div>
        <div class="flex-initial w-20">
          <div class="relative rounded-full bg-gray-800">
            <div class="text-white text-center">
              <span>Всего: {{ segment.percent }}%</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: 'CardComponent',
    props: {
      segment: Object,
    },
  };
  </script>

  <style scoped>
  </style>
