<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';


const props = defineProps({
    audiosUrl: Object,
})
</script>

<template>
    <Head title="Audios" />
    <app-layout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <h5>Audios</h5>
                    <DataView :value="audiosUrl" layout="grid" :paginator="true" :rows="12">
                        <template #grid="slotProps">
                            <div class="col-12 md:col-6 xl:col-4">
                                <div class="card m-3 border-1 surface-border">
                                    <div class="text-center">
                                        <audio controls class="w-full">
                                            {{ slotProps }}
                                            <source :src="slotProps.data" type="audio/wav">
                                            Your browser does not support the audio tag.
                                        </audio>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </DataView>
                </div>
            </div>
        </div>
    </app-layout>
</template>
