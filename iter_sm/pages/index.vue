<template>
    <div>
        <MainSection title="Главная" :loading="loading">
            Это главная страница
        </MainSection>
    </div>
</template>

<script setup>

    const loading = ref(false)

</script>