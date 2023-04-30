<script setup>
import { FilterMatchMode } from 'primevue/api';
import { ref, onMounted, onBeforeMount } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast';
import { Head, router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    publishers: Object,
});
const toast = useToast();
const publisherDialog = ref(false);
const deletePublisherDialog = ref(false);
const deletePublishersDialog = ref(false);
const publisher = ref({});
const selectedPublishers = ref(null);
const dt = ref(null);
const filters = ref({});
const submitted = ref(false);

onBeforeMount(() => {
    initFilters();
});

const hideDialog = () => {
    publisherDialog.value = false;
    submitted.value = false;
};

const confirmDeletePublisher = (editPublisher) => {
    publisher.value = editPublisher;
    deletePublisherDialog.value = true;
};

const deletePublisher = (publisher) => {
    axios.delete(route('publishers.destroy', [[publisher.id]]))
        .then((r) => {
            deletePublisherDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'Publisher Deleted', life: 3000 });
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
    deletePublishersDialog.value = true;
};

const deleteSelectedPublishers = () => {
    const itemsId = [];
    selectedPublishers.value.forEach(element => {
        itemsId.push(element.id);
    });
    axios.delete(route('publishers.destroy', [itemsId]))
        .then((r) => {
            deletePublishersDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'Publishers Deleted', life: 3000 });
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
    publisher.value = {};
    submitted.value = false;
    publisherDialog.value = true;
};

const SetPublisherData = () => {
    publisher.value.inventoryStatus = publisher.value.inventoryStatus.label || publisher.value.inventoryStatus
    publisher.value.publisher = publisher.value.publisher.id
    publisher.value.publisher = publisher.value.publisher.id
    publisher.value.translator = publisher.value.translator.id
    if (publisher.value.tags) {
        publisher.value.tag = []
        publisher.value.tags.forEach(element => {
            publisher.value.tag.push(element.id);
        });
        delete publisher.value.tags;
    }
}

const savePublisher = () => {
    submitted.value = true;
    if (publisher.value.name && publisher.value.name.trim()) {
        // Update If Publisher Exist
        if (publisher.value.id) {
            SetPublisherData();
            axios.put(route('publishers.update', [publisher.value.id, publisher.value]))
                .then((r) => {
                    console.log(r);
                    publisherDialog.value = false;
                    publisher.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'Publisher Created', life: 3000 });
                    // router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })
        }
        // Create New Publisher
        else {
            SetPublisherData();
            axios.post(route('publishers.store', [publisher.value]))
                .then((r) => {
                    publisherDialog.value = false;
                    publisher.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'Publisher Created', life: 3000 });
                    router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })

        }


    }
};

const editPublisher = (editPublisher) => {
    publisher.value = { ...editPublisher };
    publisherDialog.value = true;
};
</script>

<template>
    <Head title="Publishers" />
    <app-layout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <Toast />
                    <Toolbar class="mb-4">
                        <template v-slot:start>
                            <div class="my-2">
                                <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
                                <Button label="Delete" icon="pi pi-trash" class="p-button-danger"
                                    @click="confirmDeleteSelected"
                                    :disabled="!selectedPublishers || !selectedPublishers.length" />
                            </div>
                        </template>

                        <template v-slot:end>
                            <!-- <FileUpload mode="basic" accept="image/*" :maxFileSize="1000000" label="Import"
                                chooseLabel="Import" class="mr-2 inline-block" /> -->
                            <Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportCSV($event)" />
                        </template>
                    </Toolbar>

                    <DataTable ref="dt" :value="props.publishers" v-model:selection="selectedPublishers" dataKey="id"
                        :paginator="true" :rows="10" :filters="filters"
                        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                        :rowsPerPageOptions="[5, 10, 25]"
                        currentPageReportTemplate="Showing {first} to {last} of {totalRecords} publishers"
                        responsiveLayout="scroll">
                        <template #header>
                            <div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
                                <h5 class="m-0">Manage Publishers</h5>
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
                                    @click="editPublisher(slotProps.data)" />
                                <Button icon="pi pi-trash" class="p-button-rounded p-button-warning mt-2"
                                    @click="confirmDeletePublisher(slotProps.data)" />
                            </template>
                        </Column>
                    </DataTable>

                    <Dialog v-model:visible="publisherDialog" :style="{ width: '450px' }" header="Publisher Details"
                        :modal="true" class="p-fluid">
                        <img :src="publisher.thumbline ? publisher.thumbline : 'https://fakeimg.pl/320x220/'"
                            alt="publisher image" width="150" class="mt-0 mx-auto mb-5 block shadow-2" />

                        <div class="field">
                            <label for="name">Name</label>
                            <InputText id="name" v-model.trim="publisher.name" required="true" autofocus
                                :class="{ 'p-invalid': submitted && !publisher.name }" />
                            <small class="p-invalid" v-if="submitted && !publisher.name">Name is required.</small>
                        </div>

                        <div class="field">
                            <label for="inventoryStatus" class="mb-3">Inventory Status</label>
                            {{ publisher.inventoryStatus }}
                            <Dropdown id="inventoryStatus" v-model="publisher.inventoryStatus" :options="statuses"
                                optionLabel="label" placeholder="Select a Status"
                                :class="{ 'p-invalid': submitted && !publisher.inventoryStatus }" />
                            <small class="p-invalid" v-if="submitted && !publisher.inventoryStatus">InventoryStatus is
                                required.</small>
                        </div>

                        <div class="formgrid grid">
                            <div class="field col">
                                <label for="quantity">Quantity</label>
                                <InputNumber id="quantity" v-model="publisher.quantity" integeronly
                                    :class="{ 'p-invalid': submitted && !publisher.quantity }" />
                                <small class="p-invalid" v-if="submitted && !publisher.quantity">Quantity is required.</small>
                            </div>
                        </div>

                        <div class="field">
                            <label class="mb-3">Tags</label>
                            <MultiSelect v-model="publisher.tags" :options="tags" optionLabel="name" placeholder="Select Tags"
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
                            <label class="mb-3">publisher</label>
                            <Dropdown v-model="publisher.publisher" :options="publishers" optionLabel="name"
                                placeholder="Select Publisher" />
                        </div>

                        <div class="field">
                            <label class="mb-3">publisher</label>
                            <Dropdown v-model="publisher.publisher" :options="publishers" optionLabel="name"
                                placeholder="Select publisher" />
                        </div>

                        <div class="field">
                            <label class="mb-3">translator</label>
                            <Dropdown v-model="publisher.translator" :options="translators" optionLabel="name"
                                placeholder="Select translator" />
                        </div>

                        <template #footer>
                            <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
                            <Button label="Save" icon="pi pi-check" class="p-button-text" @click="savePublisher" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deletePublisherDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="publisher">Are you sure you want to delete <b>{{ publisher.name }}</b>?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deletePublisherDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deletePublisher(publisher)" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deletePublishersDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="publisher">Are you sure you want to delete the selected publishers?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deletePublishersDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteSelectedPublishers" />
                        </template>
                    </Dialog>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<style scoped lang="scss">@import '../../css//demo/styles/badges.scss';</style>
