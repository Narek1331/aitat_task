<template>
    <div class="grid grid-cols-4 gap-4">
        <CardComponent></CardComponent>
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
