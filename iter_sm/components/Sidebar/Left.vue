<template>
    <div class="h-screen flex flex-col">
        <div class="p-2 my-2 hover:rounded-full hover:bg-blue-50 w-min dark:hover:bg-white/20" :class="transition">
            <nuxt-link to="/">
            <LogoITer/>
        </nuxt-link>
        </div>
        
    </div>
</template>

<script setup>
    const {defaultTransition} = useTailwindConfig()
</script>