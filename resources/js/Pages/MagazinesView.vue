<script setup>
import { FilterMatchMode } from 'primevue/api';
import { ref, onMounted, onBeforeMount, watch } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast';
import { Head, Link, router } from '@inertiajs/vue3';
import axios from 'axios';
import { useI18n } from "vue-i18n";

const { locale } = useI18n();

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
const expandedRows = ref([]);
const setDirection = ref(locale == 'en' ? 'direction:ltr' : 'direction:rtl');
const getMargin = ref(locale == 'en' ? 'mr-' : 'ml-');

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


const editMagazine = (editMagazine) => {
    magazine.value = { ...editMagazine };
    magazineDialog.value = true;
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

const expandAll = () => {
    expandedRows.value = props.magazines.filter((p) => p.id);
};

const collapseAll = () => {
    expandedRows.value = null;
};

watch(locale, (val) => {
    if (val == 'en') {
        setDirection.value = 'direction:ltr';
        getMargin.value = 'mr-';
    } else {
        setDirection.value = 'direction:rtl';
        getMargin.value = 'ml-';
    }
})
</script>

<template>
    <Head title="Magazines" />
    <app-layout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
                        <li>
                            <Link href="/dashboard" class="text-500 no-underline line-height-3 cursor-pointer">dashboard
                            </Link>
                        </li>
                        <li class="px-2">
                            <i class="pi pi-angle-right text-500 line-height-3"></i>
                        </li>
                        <li>
                            <span class="text-900 line-height-3">Magazines</span>
                        </li>
                    </ul>
                    <Toolbar class="mb-4">
                        <template v-slot:start>
                            <div class="my-2">
                                <Button label="New" icon="pi pi-plus" class="p-button-success" @click="openNew" />
                            </div>
                        </template>
                    </Toolbar>
                    <DataTable :value="magazines" v-model:expandedRows="expandedRows" dataKey="id" responsiveLayout="scroll"
                        :paginator="true" :rows="10">
                        <template #header>
                            <div>
                                <Button icon="pi pi-plus" label="Expand All" @click="expandAll"
                                    :class="getMargin + '2 mb-2'" />
                                <Button icon="pi pi-minus" label="Collapse All" @click="collapseAll" class="mb-2" />
                            </div>
                        </template>
                        <Column :expander="true" headerStyle="min-width: 3rem"
                            :style="$i18n.locale == 'en' ? '' : 'rotate: 180deg;'" />
                        <Column field="name" header="Name" :sortable="true">
                            <template #body="slotProps">
                                {{ slotProps.data.name }}
                            </template>
                        </Column>
                        <Column header="Image">
                            <template #body="slotProps">
                                <img :src="slotProps.data.thumbline" :alt="slotProps.data.thumbline" class="shadow-2"
                                    width="100" />
                            </template>
                        </Column>
                        <Column field="price" header="Price" :sortable="true">
                            <template #body="slotProps">
                                {{ formatCurrency(slotProps.data.price) }}
                            </template>
                        </Column>
                        <Column field="slug" header="Slug" :sortable="true">
                            <template #body="slotProps">
                                {{ slotProps.data.slug }}
                            </template>
                        </Column>
                        <Column headerStyle="min-width:10rem;">
                            <template #body="slotProps">
                                <Button icon="pi pi-pencil"
                                    :class="'p-button-rounded p-button-success ' + getMargin + '2'" />
                                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger mt-2"
                                    @click="confirmDeleteMagazine(slotProps.data)" />
                            </template>
                        </Column>

                        <template #expansion="slotProps">
                            <div class="p-3">
                                <h5>Magazines for {{ slotProps.data.name }}</h5>
                                <DataTable :value="slotProps.data.books" responsiveLayout="scroll">
                                    <Column field="id" header="Id" :sortable="true">
                                        <template #body="slotProps">
                                            {{ slotProps.data.id }}
                                        </template>
                                    </Column>
                                    <Column field="name" header="Name" :sortable="true">
                                        <template #body="slotProps">
                                            {{ slotProps.data.name }}
                                        </template>
                                    </Column>
                                    <Column field="thumbline" header="Thumbline">
                                        <template #body="slotProps">
                                            <img :src="slotProps.data.thumbline" :alt="slotProps.data.thumbline"
                                                class="shadow-2" width="100" />
                                        </template>
                                    </Column>
                                    <Column field="price" header="Price" :sortable="true">
                                        <template #body="slotProps">
                                            {{ formatCurrency(slotProps.data.price) }}
                                        </template>
                                    </Column>
                                    <Column field="writer" header="Writer" :sortable="true">
                                        <template #body="slotProps">
                                            {{ formatCurrency(slotProps.data.writer.name) }}
                                        </template>
                                    </Column>
                                </DataTable>
                            </div>
                        </template>
                    </DataTable>

                    <!-- FIXME Change Inputs Or Convert To New Page -->
                    <!-- Recommended New Page -->
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
                                <label for="price">Price</label>
                                <InputNumber id="price" v-model="magazine.price" mode="currency" currency="IRR"
                                    locale="fa-IR" :class="{ 'p-invalid': submitted && !magazine.price }"
                                    :required="true" />
                                <small class="p-invalid" v-if="submitted && !magazine.price">Price is required.</small>
                            </div>
                            <div class="field col">
                                <label for="quantity">Quantity</label>
                                <InputNumber id="quantity" v-model="magazine.quantity" integeronly
                                    :class="{ 'p-invalid': submitted && !magazine.quantity }" />
                                <small class="p-invalid" v-if="submitted && !magazine.quantity">Quantity is
                                    required.</small>
                            </div>
                        </div>

                        <div class="field">
                            <label class="mb-3">Category</label>
                            <div class="formgrid grid">
                                <div class="field-radiobutton col-6" v-for="category in  categories ">
                                    <RadioButton id="category1" name="category" :value="category.id"
                                        v-model="magazine.category" />
                                    <label for="category1">{{ category.name }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="mb-3">Tags</label>
                            <MultiSelect v-model="magazine.tags" :options="tags" optionLabel="name"
                                placeholder="Select Tags" :filter="true">
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
                            <Dropdown v-model="magazine.writer" :options="writers" optionLabel="name"
                                placeholder="Select Writer" />
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
                            <Button label="Yes" icon="pi pi-check" class="p-button-text"
                                @click="deleteMagazine(magazine)" />
                        </template>
                    </Dialog>
                </div>
            </div>
        </div>
    </app-layout>
</template>
