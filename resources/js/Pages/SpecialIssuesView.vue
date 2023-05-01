<script setup>
import { FilterMatchMode } from 'primevue/api';
import { ref, onMounted, onBeforeMount } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast';
import { Head, Link, router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    special_issues: Object,
});
const toast = useToast();
const special_issueDialog = ref(false);
const deleteSpecialIssueDialog = ref(false);
const deleteSpecialIssuesDialog = ref(false);
const special_issue = ref({});
const selectedSpecialIssues = ref(null);
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
    special_issueDialog.value = false;
    submitted.value = false;
};

const confirmDeleteSpecialIssue = (editSpecialIssue) => {
    special_issue.value = editSpecialIssue;
    deleteSpecialIssueDialog.value = true;
};

const deleteSpecialIssue = (special_issue) => {
    axios.delete(route('special_issues.destroy', [[special_issue.id]]))
        .then((r) => {
            deleteSpecialIssueDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'SpecialIssue Deleted', life: 3000 });
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
    deleteSpecialIssuesDialog.value = true;
};

const deleteSelectedSpecialIssues = () => {
    const itemsId = [];
    selectedSpecialIssues.value.forEach(element => {
        itemsId.push(element.id);
    });
    axios.delete(route('special_issues.destroy', [itemsId]))
        .then((r) => {
            deleteSpecialIssuesDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: 'SpecialIssues Deleted', life: 3000 });
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
    special_issue.value = {};
    submitted.value = false;
    special_issueDialog.value = true;
};

const SetSpecialIssueData = () => {
    special_issue.value.inventoryStatus = special_issue.value.inventoryStatus.label || special_issue.value.inventoryStatus
    special_issue.value.special_issue = special_issue.value.special_issue.id
    special_issue.value.publisher = special_issue.value.publisher.id
    special_issue.value.translator = special_issue.value.translator.id
    if (special_issue.value.tags) {
        special_issue.value.tag = []
        special_issue.value.tags.forEach(element => {
            special_issue.value.tag.push(element.id);
        });
        delete special_issue.value.tags;
    }
}

const saveSpecialIssue = () => {
    submitted.value = true;
    if (special_issue.value.name && special_issue.value.name.trim()) {
        // Update If SpecialIssue Exist
        if (special_issue.value.id) {
            SetSpecialIssueData();
            axios.put(route('special_issues.update', [special_issue.value.id, special_issue.value]))
                .then((r) => {
                    console.log(r);
                    special_issueDialog.value = false;
                    special_issue.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'SpecialIssue Created', life: 3000 });
                    // router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })
        }
        // Create New SpecialIssue
        else {
            SetSpecialIssueData();
            axios.post(route('special_issues.store', [special_issue.value]))
                .then((r) => {
                    special_issueDialog.value = false;
                    special_issue.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'SpecialIssue Created', life: 3000 });
                    router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })

        }


    }
};

const editSpecialIssue = (editSpecialIssue) => {
    special_issue.value = { ...editSpecialIssue };
    special_issueDialog.value = true;
};
</script>

<template>
    <Head title="SpecialIssues" />
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
                            <span class="text-900 line-height-3">Special Issues</span>
                        </li>
                    </ul>
                    <Toolbar class="mb-4">
                        <template v-slot:start>
                            <div class="my-2">
                                <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
                                <Button label="Delete" icon="pi pi-trash" class="p-button-danger"
                                    @click="confirmDeleteSelected"
                                    :disabled="!selectedSpecialIssues || !selectedSpecialIssues.length" />
                            </div>
                        </template>

                        <template v-slot:end>
                            <!-- <FileUpload mode="basic" accept="image/*" :maxFileSize="1000000" label="Import"
                                chooseLabel="Import" class="mr-2 inline-block" /> -->
                            <Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportCSV($event)" />
                        </template>
                    </Toolbar>

                    <DataTable ref="dt" :value="props.special_issues" v-model:selection="selectedSpecialIssues" dataKey="id"
                        :paginator="true" :rows="10" :filters="filters"
                        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                        :rowsPerPageOptions="[5, 10, 25]"
                        currentPageReportTemplate="Showing {first} to {last} of {totalRecords} special_issues"
                        responsiveLayout="scroll">
                        <template #header>
                            <div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
                                <h5 class="m-0">Manage SpecialIssues</h5>
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
                                    @click="editSpecialIssue(slotProps.data)" />
                                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger mt-2"
                                    @click="confirmDeleteSpecialIssue(slotProps.data)" />
                            </template>
                        </Column>
                    </DataTable>

                    <Dialog v-model:visible="special_issueDialog" :style="{ width: '450px' }" header="SpecialIssue Details"
                        :modal="true" class="p-fluid">
                        <img :src="special_issue.thumbline ? special_issue.thumbline : 'https://fakeimg.pl/320x220/'"
                            alt="special_issue image" width="150" class="mt-0 mx-auto mb-5 block shadow-2" />

                        <div class="field">
                            <label for="name">Name</label>
                            <InputText id="name" v-model.trim="special_issue.name" required="true" autofocus
                                :class="{ 'p-invalid': submitted && !special_issue.name }" />
                            <small class="p-invalid" v-if="submitted && !special_issue.name">Name is required.</small>
                        </div>

                        <div class="field">
                            <label for="inventoryStatus" class="mb-3">Inventory Status</label>
                            {{ special_issue.inventoryStatus }}
                            <Dropdown id="inventoryStatus" v-model="special_issue.inventoryStatus" :options="statuses"
                                optionLabel="label" placeholder="Select a Status"
                                :class="{ 'p-invalid': submitted && !special_issue.inventoryStatus }" />
                            <small class="p-invalid" v-if="submitted && !special_issue.inventoryStatus">InventoryStatus is
                                required.</small>
                        </div>

                        <div class="formgrid grid">
                            <div class="field col">
                                <label for="quantity">Quantity</label>
                                <InputNumber id="quantity" v-model="special_issue.quantity" integeronly
                                    :class="{ 'p-invalid': submitted && !special_issue.quantity }" />
                                <small class="p-invalid" v-if="submitted && !special_issue.quantity">Quantity is required.</small>
                            </div>
                        </div>

                        <div class="field">
                            <label class="mb-3">Tags</label>
                            <MultiSelect v-model="special_issue.tags" :options="tags" optionLabel="name" placeholder="Select Tags"
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
                            <label class="mb-3">special_issue</label>
                            <Dropdown v-model="special_issue.special_issue" :options="special_issues" optionLabel="name"
                                placeholder="Select SpecialIssue" />
                        </div>

                        <div class="field">
                            <label class="mb-3">publisher</label>
                            <Dropdown v-model="special_issue.publisher" :options="publishers" optionLabel="name"
                                placeholder="Select publisher" />
                        </div>

                        <div class="field">
                            <label class="mb-3">translator</label>
                            <Dropdown v-model="special_issue.translator" :options="translators" optionLabel="name"
                                placeholder="Select translator" />
                        </div>

                        <template #footer>
                            <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
                            <Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveSpecialIssue" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteSpecialIssueDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="special_issue">Are you sure you want to delete <b>{{ special_issue.name }}</b>?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deleteSpecialIssueDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteSpecialIssue(special_issue)" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteSpecialIssuesDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="special_issue">Are you sure you want to delete the selected special_issues?</span>
                        </div>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" class="p-button-text"
                                @click="deleteSpecialIssuesDialog = false" />
                            <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteSelectedSpecialIssues" />
                        </template>
                    </Dialog>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<style scoped lang="scss">@import '../../css/demo/styles/badges.scss';</style>
