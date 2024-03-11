<template>
    <div class="container mx-auto">
        <div class="grid grid-cols-4 gap-4">
        <CardComponent></CardComponent>
        <CardComponent></CardComponent>
        <CardComponent></CardComponent>
        <CardComponent></CardComponent>
        <CardComponent></CardComponent>
        </div>
  </div>
</template>

<script>
import CardComponent from '../components/CardComponent.vue';
export default {
name: 'HomePage',
components: {
    CardComponent
},
mounted() {}
}
</script>

<style scoped>
</style>
