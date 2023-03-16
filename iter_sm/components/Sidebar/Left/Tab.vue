<template>
    <nuxt-link to="#" class="flex items-center p-3 hover:bg-gray-100 
    rounded-full w-min text-black
    dark:hover:bg-dim-200 dark:text-white" :class="defaultTransition">
        <!--icon div-->
        <div class="w-6 h-6 text-dark">
            <slot name="icon"></slot>
        </div>

        <!--name div-->
        <div class="ml-4 text-xl hidden xl:block" :class="textClasses">
            <slot name="name"></slot>
        </div>
    </nuxt-link>
</template>

//setup of properties
<script setup>
    const { defaultTransition } = useTailwindConfig()

    const props = defineProps({
        active: {
            type: Boolean,
            default: false
        }
    })

    const textClasses = computed(() => props.active ? 'font-semibold':'font-normal')
</script>