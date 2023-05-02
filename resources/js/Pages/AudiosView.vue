<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';


const props = defineProps({
    audiosUrl: Object,
})
</script>

<template>
    <app-layout>
        <div class="grid">
            <div class="col-4" v-for="(item, key) in audiosUrl" :key="key">
                <div class="card">
                    <div>
                        <audio controls>
                            <source :src="item" type="audio/wav">
                            Your browser does not support the audio tag.
                        </audio>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
