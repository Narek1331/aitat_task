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
              <span>Всего: {{ totalPercent }}%</span>
            </div>
          </div>
        </div>
      </div>
      <div>
        <p>Кол-во клиентов: {{ segment.doc_count }}</p>
        <p>Кол-во заказов: {{ segment.orders.value }}</p>
        <p>Сумма заказов: {{ segment.total.value }}</p>
        <p>Средний чек: {{ averageCheck }}</p>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: 'CardComponent',
    props: {
      segment: Object,
    },
    computed: {
      averageCheck() {
        return (this.segment.total.value / this.segment.doc_count).toFixed(2);
      },
      totalPercent() {
        return ((this.segment.total.value / this.segment.doc_count) * 100).toFixed(2);
      },
    },
  };
  </script>

  <style scoped>
  </style>
