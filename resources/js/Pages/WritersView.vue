<script setup>
import { FilterMatchMode } from 'primevue/api';
import { ref, onMounted, onBeforeMount, watch } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useToast } from 'primevue/usetoast';
import { Head, Link, router } from '@inertiajs/vue3';
import axios from 'axios';
import { useI18n } from "vue-i18n";

const { t, locale } = useI18n();

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
const getDirection = ref(locale.value == 'en' ? 'direction:ltr' : 'direction:rtl');
const getMargin = ref(locale.value == 'en' ? 'mr-' : 'ml-');

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
            toast.add({ severity: 'success', summary: 'Successful ', detail: t('Messages.Toast.Success.WriterDelete'), life: 3000 });
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
            toast.add({ severity: 'success', summary: 'Successful ', detail: t('Messages.Toast.Success.WritersDelete'), life: 3000 });
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
                    toast.add({ severity: 'success', summary: 'Successful', detail: t('Messages.Toast.Success.WriterCreated'), life: 3000 });
                    router.reload();
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

watch(locale, (val) => {
    if (val == 'en') {
        getDirection.value = 'direction:ltr';
        getMargin.value = 'mr-';
    } else {
        getDirection.value = 'direction:rtl';
        getMargin.value = 'ml-';
    }
})
</script>

<template>
    <Head title="Writers" />
    <app-layout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <Toast />
                    <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
                        <li>
                            <Link href="/dashboard" class="text-500 no-underline line-height-3 cursor-pointer">
                            {{ $t('Dashboard') }}</Link>
                        </li>
                        <li class="px-2">
                            <i class="pi pi-angle-right text-500 line-height-3"
                                :style="$i18n.locale == 'en' ? '' : 'rotate:180deg;'"></i>
                        </li>
                        <li>
                            <span class="text-900 line-height-3">{{ $t('Writers') }}</span>
                        </li>
                    </ul>
                    <Toolbar class="mb-4">
                        <template v-slot:start>
                            <div class="my-2">
                                <Button :label="$t('New')" icon="pi pi-plus" :class="'p-button-success ' + getMargin + '2'"
                                    @click="openNew" />
                                <Button :label="$t('Delete')" icon="pi pi-trash" class="p-button-danger"
                                    @click="confirmDeleteSelected"
                                    :disabled="!selectedWriters || !selectedWriters.length" />
                            </div>
                        </template>

                        <template v-slot:end>
                            <Button :label="$t('Export')" icon="pi pi-upload" class="p-button-help"
                                @click="exportCSV($event)" />
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
                                <h5 class="m-0">{{ $t('Manage') }} {{ $t('Writers') }}</h5>
                                <span class="block mt-2 md:mt-0 p-input-icon-left">
                                    <i class="pi pi-search mx-2" />
                                    <InputText v-model="filters['global'].value" :placeholder="$t('Search') + '...'" />
                                </span>
                            </div>
                        </template>

                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                        <Column field="name" :header="$t('Name')" :sortable="true"
                            headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">{{ $t('Name') }}</span>
                                {{ slotProps.data.name }}
                            </template>
                        </Column>
                        <Column :header="$t('Image')" headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">{{ $t('Image') }}</span>
                                <img src="https://fakeimg.pl/320x220/" alt="https://fakeimg.pl/320x220/" class="shadow-2"
                                    width="100" />
                            </template>
                        </Column>
                        <Column field="slug" :header="$t('Slug')" :sortable="true"
                            headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">{{ $t('Slug') }}</span>
                                {{ slotProps.data.slug }}
                            </template>
                        </Column>
                        <Column headerStyle="min-width:10rem;">
                            <template #body="slotProps">
                                <Button icon="pi pi-pencil" :class="'p-button-rounded p-button-success ' + getMargin + '2'"
                                    @click="editWriter(slotProps.data)" />
                                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger mt-2"
                                    @click="confirmDeleteWriter(slotProps.data)" />
                            </template>
                        </Column>
                    </DataTable>

                    <Dialog v-model:visible="writerDialog" :style="{ width: '450px' }"
                        :header="writer.id ? $t('Edit') + ' ' + $t('Writer') : $t('Add') + ' ' + $t('Writer')" :modal="true"
                        class="p-fluid">
                        <div :style="getDirection">
                            <img :src="writer.thumbline ? writer.thumbline : 'https://fakeimg.pl/320x220/'"
                                :alt="$t('WriterImage')" width="150" class="mt-0 mx-auto mb-5 block shadow-2" />

                            <div class="field">
                                <label for="name">{{ $t('Name') }}</label>
                                <InputText id="name" v-model.trim="writer.name" required="true" autofocus
                                    :class="{ 'p-invalid': submitted && !writer.name }" />
                                <small class="p-invalid" v-if="submitted && !writer.name">{{ $t('Messages.Required.Name')
                                }}</small>
                            </div>

                            <div class="field">
                                <label for="inventoryStatus" class="mb-3">{{ $t('InventoryStatus') }}</label>
                                {{ writer.inventoryStatus }}
                                <Dropdown id="inventoryStatus" v-model="writer.inventoryStatus" :options="statuses"
                                    optionLabel="label" placeholder="Select a Status"
                                    :class="{ 'p-invalid': submitted && !writer.inventoryStatus }" />
                                <small class="p-invalid" v-if="submitted && !writer.inventoryStatus">{{
                                    $t('Message.Required.InventoryStatus') }}</small>
                            </div>

                            <div class="formgrid grid">
                                <div class="field col">
                                    <label for="quantity">{{ $t('Quantity') }}</label>
                                    <InputNumber id="quantity" v-model="writer.quantity" integeronly
                                        :class="{ 'p-invalid': submitted && !writer.quantity }" />
                                    <small class="p-invalid" v-if="submitted && !writer.quantity">{{
                                        $t('Message.Required.Quantity') }}</small>
                                </div>
                            </div>

                            <div class="field">
                                <label class="mb-3">{{ $t('Tags') }}</label>
                                <MultiSelect v-model="writer.tags" :options="tags" optionLabel="name"
                                    :placeholder="$t('Select.Tags')" :filter="true">
                                    <template #value="slotProps">
                                        <div :class="'inline-flex align-items-center py-1 px-2 bg-primary text-primary border-round ' + getMargin + '2'"
                                            v-for=" option  of  slotProps.value " :key="option.id">
                                            <div>{{ option.name }}</div>
                                        </div>
                                        <template v-if="!slotProps.value || slotProps.value.length === 0">
                                            <div class="p-1">{{ $t('Select.Tags') }}</div>
                                        </template>
                                    </template>
                                </MultiSelect>
                            </div>

                            <div class="field">
                                <label class="mb-3">{{ $t('Writer') }}</label>
                                <Dropdown v-model="writer.writer" :options="writers" optionLabel="name"
                                    :placeholder="$t('Select.Writer')" />
                            </div>

                            <div class="field">
                                <label class="mb-3">{{ $t('Publisher') }}</label>
                                <Dropdown v-model="writer.publisher" :options="publishers" optionLabel="name"
                                    :placeholder="$t('Select.Publisher')" />
                            </div>

                            <div class="field">
                                <label class="mb-3">{{ $t('Translator') }}</label>
                                <Dropdown v-model="writer.translator" :options="translators" optionLabel="name"
                                    :placeholder="$t('Select.Translator')" />
                            </div>
                        </div>
                        <template #footer>
                            <Button :label="$t('Cancel')" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
                            <Button :label="$t('Save')" icon="pi pi-check" class="p-button-text" @click="saveWriter" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteWriterDialog" :style="{ width: '450px' }"
                        :header="$t('Confirm') + ' ' + $t('Delete')" :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i :class="'pi pi-exclamation-triangle ' + getMargin + '3'" style="font-size: 2rem" />
                            <span v-if="writer">{{ $t('Messages.Confirm.Delete', { name: writer.name }) }}</span>
                        </div>
                        <template #footer>
                            <Button :label="$t('No')" icon="pi pi-times" class="p-button-text"
                                @click="deleteWriterDialog = false" />
                            <Button :label="$t('Yes')" icon="pi pi-check" class="p-button-text"
                                @click="deleteWriter(writer)" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteWritersDialog" :style="{ width: '450px' }" header="Confirm"
                        :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i :class="'pi pi-exclamation-triangle ' + getMargin + '3'" style="font-size: 2rem" />
                            <span v-if="writer">{{ $t('Messages.Confirm.DeleteWriters') }}</span>
                        </div>
                        <template #footer>
                            <Button :label="$t('No')" icon="pi pi-times" class="p-button-text"
                                @click="deleteWritersDialog = false" />
                            <Button :label="$t('Yes')" icon="pi pi-check" class="p-button-text"
                                @click="deleteSelectedWriters" />
                        </template>
                    </Dialog>
                </div>
            </div>
        </div>
    </app-layout>
</template>
