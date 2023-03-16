<template>
    <div class="h-screen flex flex-col">
        <div class="p-2 my-2 hover:rounded-full hover:bg-blue-50 w-min 
        dark:hover:bg-white/20" :class="defaultTransition">
            <nuxt-link to="/">
            <LogoITer/>
        </nuxt-link>
        </div>

        <!--sidebar div menu-->
        <div class="mt-2 space-y-3">
            <!--Main or Home button-->
            <SidebarLeftTab active>
                <template v-slot:icon>
                    <HomeIcon />
                </template>
                <template v-slot:name>
                    Главная
                </template>
            </SidebarLeftTab>

            <!--Explore button-->
            <SidebarLeftTab>
                <template v-slot:icon>
                    <HashtagIcon />
                </template>
                <template v-slot:name>
                    Поиск
                </template>
            </SidebarLeftTab>

            <!--Notification button-->
            <SidebarLeftTab>
                <template v-slot:icon>
                    <BellIcon />
                </template>
                <template v-slot:name>
                    Уведомления
                </template>
            </SidebarLeftTab>

            <!--Messages button-->
            <SidebarLeftTab>
                <template v-slot:icon>
                    <InboxIcon />
                </template>
                <template v-slot:name>
                    Сообщения
                </template>
            </SidebarLeftTab>

            <!--Bookmarks button-->
            <SidebarLeftTab>
                <template v-slot:icon>
                    <BookmarkIcon />
                </template>
                <template v-slot:name>
                    Закладки
                </template>
            </SidebarLeftTab>

            <!--Documents button-->
            <SidebarLeftTab>
                <template v-slot:icon>
                    <DocumentTextIcon />
                </template>
                <template v-slot:name>
                    Документы
                </template>
            </SidebarLeftTab>

            <!--Profile button-->
            <SidebarLeftTab>
                <template v-slot:icon>
                    <UserIcon />
                </template>
                <template v-slot:name>
                    Профиль
                </template>
            </SidebarLeftTab>

            <!--Group button-->
            <SidebarLeftTab>
                <template v-slot:icon>
                    <UserGroupIcon />
                </template>
                <template v-slot:name>
                    Сообщества
                </template>
            </SidebarLeftTab>

            <!--Settings button-->
            <SidebarLeftTab>
                <template v-slot:icon>
                    <AdjustmentsHorizontalIcon />
                </template>
                <template v-slot:name>
                    Настройки
                </template>
            </SidebarLeftTab>
            
        </div>

        
        
    </div>
</template>

<script setup>
    import { BellAlertIcon, HomeIcon } from "@heroicons/vue/24/solid"
    import {HashtagIcon, BellIcon, InboxIcon, 
        BookmarkIcon, DocumentTextIcon, UserIcon, 
        AdjustmentsHorizontalIcon, UserGroupIcon } from "@heroicons/vue/24/outline"

    const { defaultTransition } = useTailwindConfig()
</script>