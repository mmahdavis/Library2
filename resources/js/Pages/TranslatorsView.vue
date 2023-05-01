<script setup>
import { FilterMatchMode } from 'primevue/api';
import { ref, onMounted, onBeforeMount } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast';
import { Head, Link, router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    translators: Object,
});
const toast = useToast();
const translatorDialog = ref(false);
const deleteTranslatorDialog = ref(false);
const deleteTranslatorsDialog = ref(false);
const translator = ref({});
const selectedTranslators = ref(null);
const dt = ref(null);
const filters = ref({});
const submitted = ref(false);

onBeforeMount(() => {
    initFilters();
});

const hideDialog = () => {
    translatorDialog.value = false;
    submitted.value = false;
};

const confirmDeleteTranslator = (editTranslator) => {
    translator.value = editTranslator;
    deleteTranslatorDialog.value = true;
};

const deleteTranslator = (translator) => {
    axios.delete(route('translators.destroy', [[translator.id]]))
        .then((r) => {
            deleteTranslatorDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'Translator Deleted', life: 3000 });
            router.reload();
        })
        .catch((error) => {
            toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
        })
};

const exportCSV = () => {
    dt.value.exportCSV();
};

const confirmDeleteSelected = () => {
    deleteTranslatorsDialog.value = true;
};

const deleteSelectedTranslators = () => {
    const itemsId = [];
    selectedTranslators.value.forEach(element => {
        itemsId.push(element.id);
    });
    axios.delete(route('translators.destroy', [itemsId]))
        .then((r) => {
            deleteTranslatorsDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'Translators Deleted', life: 3000 });
            router.reload();
        })
        .catch((error) => {
            toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
        })
};

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS }
    };
};

const openNew = () => {
    translator.value = {};
    submitted.value = false;
    translatorDialog.value = true;
};

const SetTranslatorData = () => {
    translator.value.inventoryStatus = translator.value.inventoryStatus.label || translator.value.inventoryStatus
    translator.value.translator = translator.value.translator.id
    translator.value.publisher = translator.value.publisher.id
    translator.value.translator = translator.value.translator.id
    if (translator.value.tags) {
        translator.value.tag = []
        translator.value.tags.forEach(element => {
            translator.value.tag.push(element.id);
        });
        delete translator.value.tags;
    }
}

const saveTranslator = () => {
    submitted.value = true;
    if (translator.value.name && translator.value.name.trim()) {
        // Update If Translator Exist
        if (translator.value.id) {
            SetTranslatorData();
            axios.put(route('translators.update', [translator.value.id, translator.value]))
                .then((r) => {
                    console.log(r);
                    translatorDialog.value = false;
                    translator.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'Translator Created', life: 3000 });
                    // router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })
        }
        // Create New Translator
        else {
            SetTranslatorData();
            axios.post(route('translators.store', [translator.value]))
                .then((r) => {
                    translatorDialog.value = false;
                    translator.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'Translator Created', life: 3000 });
                    router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })

        }


    }
};

const editTranslator = (editTranslator) => {
    translator.value = { ...editTranslator };
    translatorDialog.value = true;
};
</script>

<template>
    <Head title="Translators" />
    <app-layout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <Toast />
                    <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
                        <li>
                            <Link href="/dashboard" class="text-500 no-underline line-height-3 cursor-pointer">dashboard</Link>
                        </li>
                        <li class="px-2">
                            <i class="pi pi-angle-right text-500 line-height-3"></i>
                        </li>
                        <li>
                            <span class="text-900 line-height-3">Translators</span>
                        </li>
                    </ul>
                    <Toolbar class="mb-4">
                        <template v-slot:start>
                            <div class="my-2">
                                <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
                                <Button label="Delete" icon="pi pi-trash" class="p-button-danger"
                                    @click="confirmDeleteSelected"
                                    :disabled="!selectedTranslators || !selectedTranslators.length" />
                            </div>
                        </template>

                        <template v-slot:end>
                            <!-- <FileUpload mode="basic" accept="image/*" :maxFileSize="1000000" label="Import"
                                chooseLabel="Import" class="mr-2 inline-block" /> -->
                            <Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportCSV($event)" />
                        </template>
                    </Toolbar>

                    <DataTable ref="dt" :value="props.translators" v-model:selection="selectedTranslators" dataKey="id"
                        :paginator="true" :rows="10" :filters="filters"
                        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                        :rowsPerPageOptions="[5, 10, 25]"
                        currentPageReportTemplate="Showing {first} to {last} of {totalRecords} translators"
                        responsiveLayout="scroll">
                        <template #header>
                            <div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
                                <h5 class="m-0">Manage Translators</h5>
                                <span class="block mt-2 md:mt-0 p-input-icon-left">
                                    <i class="pi pi-search" />
                                    <InputText v-model="filters['global'].value" placeholder="Search..." />
                                </span>
                            </div>
                        </template>

                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                        <Column field="name" header="Name" :sortable="true" headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">Name</span>
                                {{ slotProps.data.name }}
                            </template>
                        </Column>
                        <Column header="Image" headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">Image</span>
                                <img src="https://fakeimg.pl/320x220/" alt="https://fakeimg.pl/320x220/" class="shadow-2"
                                    width="100" />
                            </template>
                        </Column>
                        <Column field="slug" header="Slug" :sortable="true" headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">Slug</span>
                                {{ slotProps.data.slug }}
                            </template>
                        </Column>
                        <Column headerStyle="min-width:10rem;">
                            <template #body="slotProps">
                                <Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2"
                                    @click="editTranslator(slotProps.data)" />
                                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger mt-2"
                                    @click="confirmDeleteTranslator(slotProps.data)" />
                            </template>
                        </Column>
                    </DataTable>

                    <Dialog v-model:visible="translatorDialog" :style="{ width: '450px' }" header="Translator Details"
                        :modal="true" class="p-fluid">
                        <img :src="translator.thumbline ? translator.thumbline : 'https://fakeimg.pl/320x220/'"
                            alt="translator image" width="150" class="mt-0 mx-auto mb-5 block shadow-2" />

                        <div class="field">
                            <label for="name">Name</label>
                            <InputText id="name" v-model.trim="translator.name" required="true" autofocus
                                :class="{ 'p-invalid': submitted && !translator.name }" />
                            <small class="p-invalid" v-if="submitted && !translator.name">Name is required.</small>
                        </div>

                        <div class="field">
                            <label for="inventoryStatus" class="mb-3">Inventory Status</label>
                            {{ translator.inventoryStatus }}
                            <Dropdown id="inventoryStatus" v-model="translator.inventoryStatus" :options="statuses"
                                optionLabel="label" placeholder="Select a Status"
                                :class="{ 'p-invalid': submitted && !translator.inventoryStatus }" />
                            <small class="p-invalid" v-if="submitted && !translator.inventoryStatus">InventoryStatus is
                                required.</small>
                        </div>

                        <div class="formgrid grid">
                            <div class="field col">
                                <label for="quantity">Quantity</label>
                                <InputNumber id="quantity" v-model="translator.quantity" integeronly
                                    :class="{ 'p-invalid': submitted && !translator.quantity }" />
                                <small class="p-invalid" v-if="submitted && !translator.quantity">Quantity is required.</small>
                            </div>
                        </div>

                        <div class="field">
                            <label class="mb-3">Tags</label>
                            <MultiSelect v-model="translator.tags" :options="tags" optionLabel="name" placeholder="Select Tags"
                                :filter="true">
                                <template #value="slotProps">
                                    <div class="inline-flex align-items-center py-1 px-2 bg-primary text-primary border-round mr-2"
                                        v-for=" option  of  slotProps.value " :key="option.id">
                                        <div>{{ option.name }}</div>
                                    </div>
                                    <template v-if="!slotProps.value || slotProps.value.length === 0">
                                        <div class="p-1">Select Tags</div>
                                    </template>
                                </template>
                            </MultiSelect>
                        </div>

                        <div class="field">
                            <label class="mb-3">translator</label>
                            <Dropdown v-model="translator.translator" :options="translators" optionLabel="name"
                                placeholder="Select Translator" />
                        </div>

                        <div class="field">
                            <label class="mb-3">publisher</label>
                            <Dropdown v-model="translator.publisher" :options="publishers" optionLabel="name"
                                placeholder="Select publisher" />
                        </div>

                        <div class="field">
                            <label class="mb-3">translator</label>
                            <Dropdown v-model="translator.translator" :options="translators" optionLabel="name"
                                placeholder="Select translator" />
                        </div>

                        <template #footer>
                            <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
                            <Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveTranslator" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteTranslatorDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="translator">Are you sure you want to delete <b>{{ translator.name }}</b>?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deleteTranslatorDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteTranslator(translator)" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteTranslatorsDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="translator">Are you sure you want to delete the selected translators?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deleteTranslatorsDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteSelectedTranslators" />
                        </template>
                    </Dialog>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<style scoped lang="scss">@import '../../css/demo/styles/badges.scss';</style>
