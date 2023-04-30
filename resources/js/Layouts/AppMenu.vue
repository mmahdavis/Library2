<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        label: 'Home',
        items: [{ label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/dashboard/' }]
    },
    {
        label: 'Books',
        items: [
            { label: 'All Books', icon: 'pi pi-fw pi-book', to: '/dashboard/books' },
            { label: 'Writers', icon: 'pi pi-fw pi-pencil', to: '/dashboard/writers' },
            { label: 'Publishers', icon: 'pi pi-fw pi-file-export', to: '/dashboard/publishers' },
            { label: 'Translators', icon: 'pi pi-fw pi-language', to: '/dashboard/translators' },
        ]
    },
    {
        label: 'Magazines',
        items: [
            { label: 'All Magazines', icon: 'pi pi-fw pi-calendar', to: '/dashboard/magazines', badge: 'NEW' },
        ]
    },
    {
        label: 'Special Issues',
        items: [
            { label: 'All Special Issues', icon: 'pi pi-fw pi-file', to: '/dashboard/special_issues' },
        ]
    },
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>
