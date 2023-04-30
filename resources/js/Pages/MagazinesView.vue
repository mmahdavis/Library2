<script setup>
import { FilterMatchMode } from 'primevue/api';
import { ref, onMounted, onBeforeMount } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast';
import { Head, router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    magazines: Object,
});
const toast = useToast();
const magazineDialog = ref(false);
const deleteMagazineDialog = ref(false);
const deleteMagazinesDialog = ref(false);
const magazine = ref({});
const selectedMagazines = ref(null);
const dt = ref(null);
const filters = ref({});
const submitted = ref(false);

onBeforeMount(() => {
    initFilters();
});

const formatCurrency = (value) => {
    return value.toLocaleString('fa-IR', { style: 'currency', currency: 'IRR' });
};

const hideDialog = () => {
    magazineDialog.value = false;
    submitted.value = false;
};

const confirmDeleteMagazine = (editMagazine) => {
    magazine.value = editMagazine;
    deleteMagazineDialog.value = true;
};

const deleteMagazine = (magazine) => {
    axios.delete(route('magazines.destroy', [[magazine.id]]))
        .then((r) => {
            deleteMagazineDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'Magazine Deleted', life: 3000 });
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
    deleteMagazinesDialog.value = true;
};

const deleteSelectedMagazines = () => {
    const itemsId = [];
    selectedMagazines.value.forEach(element => {
        itemsId.push(element.id);
    });
    axios.delete(route('magazines.destroy', [itemsId]))
        .then((r) => {
            deleteMagazinesDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'Magazines Deleted', life: 3000 });
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
    magazine.value = {};
    submitted.value = false;
    magazineDialog.value = true;
};

const SetMagazineData = () => {
    magazine.value.inventoryStatus = magazine.value.inventoryStatus.label || magazine.value.inventoryStatus
    magazine.value.magazine = magazine.value.magazine.id
    magazine.value.publisher = magazine.value.publisher.id
    magazine.value.translator = magazine.value.translator.id
    if (magazine.value.tags) {
        magazine.value.tag = []
        magazine.value.tags.forEach(element => {
            magazine.value.tag.push(element.id);
        });
        delete magazine.value.tags;
    }
}

const saveMagazine = () => {
    submitted.value = true;
    if (magazine.value.name && magazine.value.name.trim()) {
        // Update If Magazine Exist
        if (magazine.value.id) {
            SetMagazineData();
            axios.put(route('magazines.update', [magazine.value.id, magazine.value]))
                .then((r) => {
                    console.log(r);
                    magazineDialog.value = false;
                    magazine.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'Magazine Created', life: 3000 });
                    // router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })
        }
        // Create New Magazine
        else {
            SetMagazineData();
            axios.post(route('magazines.store', [magazine.value]))
                .then((r) => {
                    magazineDialog.value = false;
                    magazine.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'Magazine Created', life: 3000 });
                    router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })

        }


    }
};

const editMagazine = (editMagazine) => {
    magazine.value = { ...editMagazine };
    magazineDialog.value = true;
};
</script>

<template>
    <Head title="Magazines" />
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
                                    :disabled="!selectedMagazines || !selectedMagazines.length" />
                            </div>
                        </template>

                        <template v-slot:end>
                            <!-- <FileUpload mode="basic" accept="image/*" :maxFileSize="1000000" label="Import"
                                chooseLabel="Import" class="mr-2 inline-block" /> -->
                            <Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportCSV($event)" />
                        </template>
                    </Toolbar>

                    <DataTable ref="dt" :value="props.magazines" v-model:selection="selectedMagazines" dataKey="id"
                        :paginator="true" :rows="10" :filters="filters"
                        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                        :rowsPerPageOptions="[5, 10, 25]"
                        currentPageReportTemplate="Showing {first} to {last} of {totalRecords} magazines"
                        responsiveLayout="scroll">
                        <template #header>
                            <div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
                                <h5 class="m-0">Manage Magazines</h5>
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
                        <Column field="price" header="Price" :sortable="true" headerStyle="width:14%; min-width:8rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">Price</span>
                                {{ formatCurrency(slotProps.data.price) }}
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
                                    @click="editMagazine(slotProps.data)" />
                                <Button icon="pi pi-trash" class="p-button-rounded p-button-warning mt-2"
                                    @click="confirmDeleteMagazine(slotProps.data)" />
                            </template>
                        </Column>
                    </DataTable>

                    <Dialog v-model:visible="magazineDialog" :style="{ width: '450px' }" header="Magazine Details"
                        :modal="true" class="p-fluid">
                        <img :src="magazine.thumbline ? magazine.thumbline : 'https://fakeimg.pl/320x220/'"
                            alt="magazine image" width="150" class="mt-0 mx-auto mb-5 block shadow-2" />

                        <div class="field">
                            <label for="name">Name</label>
                            <InputText id="name" v-model.trim="magazine.name" required="true" autofocus
                                :class="{ 'p-invalid': submitted && !magazine.name }" />
                            <small class="p-invalid" v-if="submitted && !magazine.name">Name is required.</small>
                        </div>

                        <div class="field">
                            <label for="inventoryStatus" class="mb-3">Inventory Status</label>
                            {{ magazine.inventoryStatus }}
                            <Dropdown id="inventoryStatus" v-model="magazine.inventoryStatus" :options="statuses"
                                optionLabel="label" placeholder="Select a Status"
                                :class="{ 'p-invalid': submitted && !magazine.inventoryStatus }" />
                            <small class="p-invalid" v-if="submitted && !magazine.inventoryStatus">InventoryStatus is
                                required.</small>
                        </div>

                        <div class="formgrid grid">
                            <div class="field col">
                                <label for="quantity">Quantity</label>
                                <InputNumber id="quantity" v-model="magazine.quantity" integeronly
                                    :class="{ 'p-invalid': submitted && !magazine.quantity }" />
                                <small class="p-invalid" v-if="submitted && !magazine.quantity">Quantity is required.</small>
                            </div>
                        </div>

                        <div class="field">
                            <label class="mb-3">Tags</label>
                            <MultiSelect v-model="magazine.tags" :options="tags" optionLabel="name" placeholder="Select Tags"
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
                            <label class="mb-3">magazine</label>
                            <Dropdown v-model="magazine.magazine" :options="magazines" optionLabel="name"
                                placeholder="Select Magazine" />
                        </div>

                        <div class="field">
                            <label class="mb-3">publisher</label>
                            <Dropdown v-model="magazine.publisher" :options="publishers" optionLabel="name"
                                placeholder="Select publisher" />
                        </div>

                        <div class="field">
                            <label class="mb-3">translator</label>
                            <Dropdown v-model="magazine.translator" :options="translators" optionLabel="name"
                                placeholder="Select translator" />
                        </div>

                        <template #footer>
                            <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
                            <Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveMagazine" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteMagazineDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="magazine">Are you sure you want to delete <b>{{ magazine.name }}</b>?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deleteMagazineDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteMagazine(magazine)" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteMagazinesDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="magazine">Are you sure you want to delete the selected magazines?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deleteMagazinesDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteSelectedMagazines" />
                        </template>
                    </Dialog>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<style scoped lang="scss">@import '../../css//demo/styles/badges.scss';</style>
