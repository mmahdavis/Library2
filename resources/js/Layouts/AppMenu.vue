<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const enMenuList = ref([
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
    {
        label: 'Media',
        items: [
            { label: 'Images', icon: 'pi pi-fw pi-images', to: '/dashboard/images' },
            { label: 'Audio', icon: 'pi pi-fw pi-volume-off', to: '/dashboard/audios' },
            { label: 'PDFs', icon: 'pi pi-fw pi-file-pdf', to: '/dashboard/pdfs' },
        ]
    },
]);

const faMenuList = ref([
    {
        label: 'خانه',
        items: [{ label: 'داشبورد', icon: 'pi pi-fw pi-home', to: '/dashboard/' }]
    },
    {
        label: 'کتاب ها',
        items: [
            { label: 'لیست کتاب ها', icon: 'pi pi-fw pi-book', to: '/dashboard/books' },
            { label: 'نویسندگان', icon: 'pi pi-fw pi-pencil', to: '/dashboard/writers' },
            { label: 'ناشران', icon: 'pi pi-fw pi-file-export', to: '/dashboard/publishers' },
            { label: 'مترجمان', icon: 'pi pi-fw pi-language', to: '/dashboard/translators' },
        ]
    },
    {
        label: 'مجلات',
        items: [
            { label: 'لیست مجلات', icon: 'pi pi-fw pi-calendar', to: '/dashboard/magazines', badge: 'NEW' },
        ]
    },
    {
        label: 'ویژه نامه ها',
        items: [
            { label: 'لیست ویژه نامه ها', icon: 'pi pi-fw pi-file', to: '/dashboard/special_issues' },
        ]
    },
    {
        label: 'گالری',
        items: [
            { label: 'عکس ها', icon: 'pi pi-fw pi-images', to: '/dashboard/images' },
            { label: 'صوت ها', icon: 'pi pi-fw pi-volume-off', to: '/dashboard/audios' },
            { label: 'پی دی اف ها', icon: 'pi pi-fw pi-file-pdf', to: '/dashboard/pdfs' },
        ]
    },
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in $i18n.locale == 'en' ? enMenuList : faMenuList" :key="item">
            <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>
