<template>
    <div class="grid grid-cols-4 gap-4">
      <CardComponent v-for="(segment, index) in segments" :key="index" :segment="segment"></CardComponent>
    </div>
  </template>

  <script>
  import CardComponent from '../components/CardComponent.vue';

  export default {
    name: 'HomePage',
    components: {
      CardComponent,
    },
    data() {
      return {
        segments: [],
      };
    },
    mounted() {
      this.$store.dispatch('fetchSegments')
        .then(() => {
          this.segments = this.$store.getters.getSegments;
        });
    },
  };
  </script>

  <style scoped>
  </style>
