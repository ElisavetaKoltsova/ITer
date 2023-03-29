<template>
    <div>
        <MainSection title="Главная" :loading="loading">
            {{user.name}}
        </MainSection>
    </div>
</template>

<script setup>

    const loading = ref(false)
    const {useAuthUser} = useAuth()

    const user = useAuthUser()

</script>