<script setup>
import { ref, computed, onMounted, onBeforeUnmount, watch } from 'vue';
import { useLayout } from '@/Layouts/composables/layout';
import { Link } from '@inertiajs/vue3';
import { useI18n } from "vue-i18n";
import { useToast } from 'primevue/usetoast';

const { t, locale } = useI18n();

const { layoutConfig, onMenuToggle } = useLayout();

const outsideClickListener = ref(null);
const topbarMenuActive = ref(false);
const toast = useToast();

onMounted(() => {
    bindOutsideClickListener();
});

onBeforeUnmount(() => {
    unbindOutsideClickListener();
});

const logoUrl = computed(() => {
    return `/layout/images/logo.png`;
});

const onTopBarMenuButton = () => {
    topbarMenuActive.value = !topbarMenuActive.value;
};

const topbarMenuClasses = computed(() => {
    return {
        'layout-topbar-menu-mobile-active': topbarMenuActive.value
    };
});

const bindOutsideClickListener = () => {
    if (!outsideClickListener.value) {
        outsideClickListener.value = (event) => {
            if (isOutsideClicked(event)) {
                topbarMenuActive.value = false;
            }
        };
        document.addEventListener('click', outsideClickListener.value);
    }
};

const unbindOutsideClickListener = () => {
    if (outsideClickListener.value) {
        document.removeEventListener('click', outsideClickListener);
        outsideClickListener.value = null;
    }
};

const isOutsideClicked = (event) => {
    if (!topbarMenuActive.value) return;

    const sidebarEl = document.querySelector('.layout-topbar-menu');
    const topbarEl = document.querySelector('.layout-topbar-menu-button');

    return !(sidebarEl.isSameNode(event.target) || sidebarEl.contains(event.target) || topbarEl.isSameNode(event.target) || topbarEl.contains(event.target));
};

const changeLanguage = () => {
    if (locale.value == 'en') {
        localStorage.setItem("language", 'fa');
        locale.value = 'fa';
    } else {
        localStorage.setItem("language", 'en');
        locale.value = 'en';
    }
}
const menu = ref(false);
const toggleMenu = (event) => {
    menu.value.toggle(event);
};
</script>

<template>
    <div class="layout-topbar">
        <Link href="/dashboard" class="layout-topbar-logo">
        <img :src="logoUrl" alt="logo" />
        </Link>

        <button class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle()">
            <i class="pi pi-bars"></i>
        </button>

        <button class="p-link layout-topbar-menu-button layout-topbar-button" @click="onTopBarMenuButton()">
            <i class="pi pi-ellipsis-v"></i>
        </button>

        <div class="layout-topbar-menu" :class="topbarMenuClasses">
            <Menu ref="menu" :popup="true">
                <template #start>
                    <button
                        class="w-full p-link flex align-items-center p-2 pl-4 text-color hover:surface-200 border-noround">
                        <Link :href="route('dashboard.profile')" class="ml-2 p-menuitem-text no-underline">
                        <i class="pi pi-user" />
                        Profile
                        </Link>
                    </button>
                    <button
                        class="w-full p-link flex align-items-center p-2 pl-4 text-color hover:surface-200 border-noround">
                        <Link :href="route('dashboard.notification')" class="ml-2 p-menuitem-text no-underline">
                        <i class="pi pi-bell" />
                        Notification
                        </Link>
                    </button>
                    <button
                        class="w-full p-link flex align-items-center p-2 pl-4 text-color hover:surface-200 border-noround">
                        <Link :href="route('logout')" method="post" class="ml-2 p-menuitem-text no-underline">
                        <i class="pi pi-sign-out" />
                        Log Out
                        </Link>
                    </button>
                </template>
            </Menu>
            <button class="p-link layout-topbar-button" icon="pi pi-angle-down" @click="toggleMenu">
                <i class="pi pi-user"></i>
                <span>{{ $t('appTopBar.profile') }}</span>
            </button>
            <!-- <button @click="toggle()" aria-haspopup="true" aria-controls="overlay_menu" class="p-link layout-topbar-button">
                <i class="pi pi-user"></i>
                <span>{{ $t('appTopBar.profile') }}</span>
            </button>
            <Menu v-if="menu" id="overlay_menu" :model="items" /> -->
            <button @click="changeLanguage()" class="p-link layout-topbar-button">
                <i class="pi pi-language"></i>
                <span>{{ $t('appTopBar.language') }}</span>
            </button>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
