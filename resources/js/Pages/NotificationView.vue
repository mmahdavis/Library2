<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    notifications: Object,
});
</script>

<template>
    <Head title="Dashboard" />
    <app-layout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <DataView :value="notifications">
                        <template #list="slotProps">
                            {{ slotProps.data }}
                            <div class="col-12">
                                <div class="flex xl:flex-row xl:align-items-start p-4 gap-4 p-message-error">
                                    <div class="icon">

                                    </div>
                                    <div class="context">
                                        <div class="font-bold m-2">{{ slotProps.data.title }}</div>
                                        <div class="mx-2">{{ slotProps.data.message }}</div>
                                    </div>
                                    <div class="action"></div>

                                </div>
                            </div>
                        </template>
                    </DataView>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<style scoped>

</style>
