<script setup>
import { FilterMatchMode } from 'primevue/api';
import { ref, onMounted, onBeforeMount } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast';
import { Head, router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    writers: Object,
});
const toast = useToast();
const writerDialog = ref(false);
const deleteWriterDialog = ref(false);
const deleteWritersDialog = ref(false);
const writer = ref({});
const selectedWriters = ref(null);
const dt = ref(null);
const filters = ref({});
const submitted = ref(false);

onBeforeMount(() => {
    initFilters();
});

const hideDialog = () => {
    writerDialog.value = false;
    submitted.value = false;
};

const confirmDeleteWriter = (editWriter) => {
    writer.value = editWriter;
    deleteWriterDialog.value = true;
};

const deleteWriter = (writer) => {
    axios.delete(route('writers.destroy', [[writer.id]]))
        .then((r) => {
            deleteWriterDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'Writer Deleted', life: 3000 });
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
    deleteWritersDialog.value = true;
};

const deleteSelectedWriters = () => {
    const itemsId = [];
    selectedWriters.value.forEach(element => {
        itemsId.push(element.id);
    });
    axios.delete(route('writers.destroy', [itemsId]))
        .then((r) => {
            deleteWritersDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'Writers Deleted', life: 3000 });
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
    writer.value = {};
    submitted.value = false;
    writerDialog.value = true;
};

const SetWriterData = () => {
    writer.value.inventoryStatus = writer.value.inventoryStatus.label || writer.value.inventoryStatus
    writer.value.writer = writer.value.writer.id
    writer.value.publisher = writer.value.publisher.id
    writer.value.translator = writer.value.translator.id
    if (writer.value.tags) {
        writer.value.tag = []
        writer.value.tags.forEach(element => {
            writer.value.tag.push(element.id);
        });
        delete writer.value.tags;
    }
}

const saveWriter = () => {
    submitted.value = true;
    if (writer.value.name && writer.value.name.trim()) {
        // Update If Writer Exist
        if (writer.value.id) {
            SetWriterData();
            axios.put(route('writers.update', [writer.value.id, writer.value]))
                .then((r) => {
                    console.log(r);
                    writerDialog.value = false;
                    writer.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'Writer Created', life: 3000 });
                    // router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })
        }
        // Create New Writer
        else {
            SetWriterData();
            axios.post(route('writers.store', [writer.value]))
                .then((r) => {
                    writerDialog.value = false;
                    writer.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'Writer Created', life: 3000 });
                    router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })

        }


    }
};

const editWriter = (editWriter) => {
    writer.value = { ...editWriter };
    writerDialog.value = true;
};
</script>

<template>
    <Head title="Writers" />
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
                                    :disabled="!selectedWriters || !selectedWriters.length" />
                            </div>
                        </template>

                        <template v-slot:end>
                            <!-- <FileUpload mode="basic" accept="image/*" :maxFileSize="1000000" label="Import"
                                chooseLabel="Import" class="mr-2 inline-block" /> -->
                            <Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportCSV($event)" />
                        </template>
                    </Toolbar>

                    <DataTable ref="dt" :value="props.writers" v-model:selection="selectedWriters" dataKey="id"
                        :paginator="true" :rows="10" :filters="filters"
                        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                        :rowsPerPageOptions="[5, 10, 25]"
                        currentPageReportTemplate="Showing {first} to {last} of {totalRecords} writers"
                        responsiveLayout="scroll">
                        <template #header>
                            <div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
                                <h5 class="m-0">Manage Writers</h5>
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
                                    @click="editWriter(slotProps.data)" />
                                <Button icon="pi pi-trash" class="p-button-rounded p-button-warning mt-2"
                                    @click="confirmDeleteWriter(slotProps.data)" />
                            </template>
                        </Column>
                    </DataTable>

                    <Dialog v-model:visible="writerDialog" :style="{ width: '450px' }" header="Writer Details"
                        :modal="true" class="p-fluid">
                        <img :src="writer.thumbline ? writer.thumbline : 'https://fakeimg.pl/320x220/'"
                            alt="writer image" width="150" class="mt-0 mx-auto mb-5 block shadow-2" />

                        <div class="field">
                            <label for="name">Name</label>
                            <InputText id="name" v-model.trim="writer.name" required="true" autofocus
                                :class="{ 'p-invalid': submitted && !writer.name }" />
                            <small class="p-invalid" v-if="submitted && !writer.name">Name is required.</small>
                        </div>

                        <div class="field">
                            <label for="inventoryStatus" class="mb-3">Inventory Status</label>
                            {{ writer.inventoryStatus }}
                            <Dropdown id="inventoryStatus" v-model="writer.inventoryStatus" :options="statuses"
                                optionLabel="label" placeholder="Select a Status"
                                :class="{ 'p-invalid': submitted && !writer.inventoryStatus }" />
                            <small class="p-invalid" v-if="submitted && !writer.inventoryStatus">InventoryStatus is
                                required.</small>
                        </div>

                        <div class="formgrid grid">
                            <div class="field col">
                                <label for="quantity">Quantity</label>
                                <InputNumber id="quantity" v-model="writer.quantity" integeronly
                                    :class="{ 'p-invalid': submitted && !writer.quantity }" />
                                <small class="p-invalid" v-if="submitted && !writer.quantity">Quantity is required.</small>
                            </div>
                        </div>

                        <div class="field">
                            <label class="mb-3">Tags</label>
                            <MultiSelect v-model="writer.tags" :options="tags" optionLabel="name" placeholder="Select Tags"
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
                            <label class="mb-3">writer</label>
                            <Dropdown v-model="writer.writer" :options="writers" optionLabel="name"
                                placeholder="Select Writer" />
                        </div>

                        <div class="field">
                            <label class="mb-3">publisher</label>
                            <Dropdown v-model="writer.publisher" :options="publishers" optionLabel="name"
                                placeholder="Select publisher" />
                        </div>

                        <div class="field">
                            <label class="mb-3">translator</label>
                            <Dropdown v-model="writer.translator" :options="translators" optionLabel="name"
                                placeholder="Select translator" />
                        </div>

                        <template #footer>
                            <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
                            <Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveWriter" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteWriterDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="writer">Are you sure you want to delete <b>{{ writer.name }}</b>?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deleteWriterDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteWriter(writer)" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteWritersDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="writer">Are you sure you want to delete the selected writers?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deleteWritersDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteSelectedWriters" />
                        </template>
                    </Dialog>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<style scoped lang="scss">@import '../../css//demo/styles/badges.scss';</style>
