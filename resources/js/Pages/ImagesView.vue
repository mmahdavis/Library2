<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    imagesUrl: Object,
});

const deleteImage = (image) => {
    console.log(image);
}
</script>

<template>
    <Head title="Gallery" />
    <app-layout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <h5>Image Gallery</h5>
                    <DataView :value="imagesUrl" layout="grid" :paginator="true" :rows="12">

                        <template #grid="slotProps">
                            <div class="col-12 md:col-4">
                                <div class="card m-3 border-1 surface-border">
                                    <div class="text-center">
                                        <img :src="slotProps.data" :alt="slotProps.data"
                                            class="w-9 shadow-2 my-3 mx-0" />
                                        <div class="text-2xl font-bold">{{ 'name' }}</div>
                                    </div>
                                    <Button icon="pi pi-trash" class="p-button-danger mt-5 w-full"
                                    @click="deleteImage(slotProps.data)" />
                                </div>
                            </div>
                        </template>
                    </DataView>
                </div>
            </div>
        </div>
    </app-layout>
</template>
