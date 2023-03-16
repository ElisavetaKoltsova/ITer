<template>
    <div class="flex flex-col">
        <!--Prewiew card: Popular tags-->
        <SidebarRightPreviewCard title="Популярные запросы">
            <SidebarRightPreviewCardItem v-for="whatsHappening in whatsHappeningItems">
                <div>
                    <h2 class="font-bold text-gray-800 text-md
                    dark:text-white">
                        {{ whatsHappening.title }}</h2>
                    <p class="text-xs text-gray-400">
                        {{ whatsHappening.count }}</p>
                </div>
            </SidebarRightPreviewCardItem>
        </SidebarRightPreviewCard>

        <!--Prewiew card: Who to follow-->
        <SidebarRightPreviewCard title="Подпишись">
            <SidebarRightPreviewCardItem v-for="whoToFollow in whoToFollowItems">
                <div class="flex flex-row justify-between p-2 items-center ">
                    <div class="flex flex-row">
                        <img :src="whoToFollow.image" :alt="whoToFollow.name" class="w-10 h-10 rounded-full">
                        <div class="flex flex-col ml-2">
                            <h1 class="text-sm font-bold text-gray-900
                            dark:text-white">{{ whoToFollow.name }}</h1>
                            <p class="text-xs text-gray-400">{{ whoToFollow.handle }}</p>
                        </div>
                    </div>
                    <!--button follow-->
                    <div class="flex h-full">
                        <button class="px-4 py-2 font-bold text-xs text-white bg-black
                        dark:text-black dark:bg-white rounded-full">Add+</button>
                    </div>
                </div>
            </SidebarRightPreviewCardItem>
        </SidebarRightPreviewCard>

        
    </div>
</template>

<script setup>

    

    const whatsHappeningItems = ref([
        {
            title: 'C# world',
            count: '18.8k posts'
        },
        {
            title: '#PostgreSQL',
            count: '10.2k posts'
        },
        {
            title: 'Web-programmer',
            count: '8.3k posts'
        }
    ])

    const whoToFollowItems = ref([
        {
            name: 'Lisa',
            handle: '@kuricakaka',
            image: 'https://picsum.photos/200/200'
        },
        {
            name: 'Mark',
            handle: '@MarkFirst',
            image: 'https://picsum.photos/200/200'
        },
        {
            name: 'Mask',
            handle: '@Ilon',
            image: 'https://picsum.photos/200/200'
        }
    ])

</script>