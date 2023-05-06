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
    books: Object,
    categories: Object,
    tags: Object,
    writers: Object,
    publishers: Object,
    translators: Object,
});
const toast = useToast();
const bookDialog = ref(false);
const deleteBookDialog = ref(false);
const deleteBooksDialog = ref(false);
const book = ref({});
const selectedBooks = ref(null);
const dt = ref(null);
const filters = ref({});
const submitted = ref(false);
const statuses = ref([
    { label: 'INSTOCK', value: 'instock' },
    { label: 'LOWSTOCK', value: 'lowstock' },
    { label: 'OUTOFSTOCK', value: 'outofstock' }
]);
const getDirection = ref(locale.value == 'en' ? 'direction:ltr' : 'direction:rtl');
const getMargin = ref(locale.value == 'en' ? 'mr-' : 'ml-');
onBeforeMount(() => {
    initFilters();
});

const formatCurrency = (value) => {
    return value.toLocaleString('fa-IR', { style: 'currency', currency: 'IRR' });
};

const hideDialog = () => {
    bookDialog.value = false;
    submitted.value = false;
};

const confirmDeleteBook = (editBook) => {
    book.value = editBook;
    deleteBookDialog.value = true;
};

const deleteBook = (book) => {
    axios.delete(route('books.destroy', [[book.id]]))
        .then((r) => {
            deleteBookDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: t('Messages.Toast.Success.BookDelete'), life: 3000 });
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
    deleteBooksDialog.value = true;
};

const deleteSelectedBooks = () => {
    const itemsId = [];
    selectedBooks.value.forEach(element => {
        itemsId.push(element.id);
    });
    axios.delete(route('books.destroy', [itemsId]))
        .then((r) => {
            deleteBooksDialog.value = false;
            toast.add({ severity: 'success', summary: 'Successful ', detail: t('Messages.Toast.Success.BooksDelete'), life: 3000 });
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
    book.value = {};
    submitted.value = false;
    bookDialog.value = true;
};

const SetBookData = () => {
    book.value.inventoryStatus = book.value.inventoryStatus.label || book.value.inventoryStatus
    book.value.writer = book.value.writer.id
    book.value.publisher = book.value.publisher.id
    book.value.translator = book.value.translator.id
    if (book.value.tags) {
        book.value.tag = []
        book.value.tags.forEach(element => {
            book.value.tag.push(element.id);
        });
        delete book.value.tags;
    }
}

const saveBook = () => {
    submitted.value = true;
    if (book.value.name && book.value.name.trim() && book.value.price) {
        // Update If Book Exist
        if (book.value.id) {
            SetBookData();
            axios.put(route('books.update', [book.value.id, book.value]))
                .then((r) => {
                    console.log(r);
                    bookDialog.value = false;
                    book.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: t('Messages.Toast.Success.BooksCreated'), life: 3000 });
                    router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })
        }
        // Create New Book
        else {
            SetBookData();
            axios.post(route('books.store', [book.value]))
                .then((r) => {
                    bookDialog.value = false;
                    book.value = {};
                    toast.add({ severity: 'success', summary: 'Successful', detail: 'Book Created', life: 3000 });
                    router.reload();
                })
                .catch((error) => {
                    toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
                })

        }


    }
};

const editBook = (editBook) => {
    book.value = { ...editBook };
    bookDialog.value = true;
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
    <Head title="Books" />
    <app-layout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <Toast />
                    <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
                        <li>
                            <Link href="/dashboard" class="text-500 no-underline line-height-3 cursor-pointer">{{
                                $t('Dashboard') }}</Link>
                        </li>
                        <li class="px-2">
                            <i class="pi pi-angle-right text-500 line-height-3"
                                :style="$i18n.locale == 'en' ? '' : 'rotate:180deg;'"></i>
                        </li>
                        <li>
                            <span class="text-900 line-height-3">{{ $t('Books') }}</span>
                        </li>
                    </ul>
                    <Toolbar class="mb-4">
                        <template v-slot:start>
                            <div class="my-2">
                                <Link :href="route('books.create')">
                                    <Button :label="$t('New')" icon="pi pi-plus"
                                        :class="'p-button-success ' + getMargin + '2'" />
                                </Link>
                                <Button :label="$t('Delete')" icon="pi pi-trash" class="p-button-danger"
                                    @click="confirmDeleteSelected" :disabled="!selectedBooks || !selectedBooks.length" />
                            </div>
                        </template>

                        <template v-slot:end>
                            <Button :label="$t('Export')" icon="pi pi-upload" class="p-button-help"
                                @click="exportCSV($event)" />
                        </template>
                    </Toolbar>

                    <DataTable ref="dt" :value="props.books" v-model:selection="selectedBooks" dataKey="id"
                        :paginator="true" :rows="10" :filters="filters"
                        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                        :rowsPerPageOptions="[5, 10, 25]"
                        currentPageReportTemplate="Showing {first} to {last} of {totalRecords} books"
                        responsiveLayout="scroll">
                        <template #header>
                            <div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
                                <h5 class="m-0">{{ $t('Manage') }} {{ $t('Books') }}</h5>
                                <span class="block mt-2 md:mt-0 p-input-icon-left">
                                    <i class="pi pi-search mx-2" />
                                    <InputText v-model="filters['global'].value" :placeholder="$t('Search') + '...'" />
                                </span>
                            </div>
                        </template>

                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                        <Column field="code" :header="$t('Code')" :sortable="true"
                            headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">{{ $t('Code') }}</span>
                                {{ slotProps.data.code }}
                            </template>
                        </Column>
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
                                <img :src="slotProps.data.thumbline" :alt="slotProps.data.thumbline" class="shadow-2"
                                    width="100" />
                            </template>
                        </Column>
                        <Column field="price" :header="$t('Price')" :sortable="true"
                            headerStyle="width:14%; min-width:8rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">{{ $t('Price') }}</span>
                                {{ formatCurrency(slotProps.data.price) }}
                            </template>
                        </Column>
                        <Column field="category" :header="$t('Category')" :sortable="true"
                            headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">{{ $t('Category') }}</span>
                                {{ slotProps.data.category.name }}
                            </template>
                        </Column>
                        <Column field="rating" :header="$t('Reviews')" :sortable="true"
                            headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">{{ $t('Reviews') }}</span>
                                <Rating :modelValue="slotProps.data.like" :readonly="true" :cancel="false" />
                            </template>
                        </Column>
                        <Column field="inventoryStatus" :header="$t('Status')" :sortable="true"
                            headerStyle="width:14%; min-width:10rem;">
                            <template #body="slotProps">
                                <span class="p-column-title">{{ $t('Status') }}</span>
                                <span
                                    :class="'book-badge status-' + (slotProps.data.inventoryStatus ? slotProps.data.inventoryStatus.toLowerCase() : '')">{{
                                        slotProps.data.inventoryStatus }}</span>
                            </template>
                        </Column>
                        <Column headerStyle="min-width:10rem;">
                            <template #body="slotProps">
                                <Button icon="pi pi-pencil" :class="'p-button-rounded p-button-success ' + getMargin + '2'"
                                    @click="editBook(slotProps.data)" />
                                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger mt-2"
                                    @click="confirmDeleteBook(slotProps.data)" />
                            </template>
                        </Column>
                    </DataTable>

                    <Dialog v-model:visible="bookDialog" :style="{ width: '450px' }"
                        :header="book.id ? $t('Edit') + ' ' + $t('Book') : $t('Add') + ' ' + $t('Book')" :modal="true"
                        class="p-fluid">
                        <div :style="getDirection">
                            <img :src="book.thumbline ? book.thumbline : 'https://fakeimg.pl/320x220/'"
                                :alt="$t('BookImage')" width="150" class="mt-0 mx-auto mb-5 block shadow-2" />

                            <div class="field">
                                <label for="name">{{ $t('Name') }}</label>
                                <InputText id="name" v-model.trim="book.name" required="true" autofocus
                                    :class="{ 'p-invalid': submitted && !book.name }" />
                                <small class="p-invalid" v-if="submitted && !book.name">{{ $t('Messages.Required.Name')
                                }}</small>
                            </div>

                            <div class="field">
                                <label for="inventoryStatus" class="mb-3">{{ $t('InventoryStatus') }}</label>
                                <Dropdown id="inventoryStatus" v-model="book.inventoryStatus" :options="statuses"
                                    optionLabel="label" :placeholder="$t('Select.Status')"
                                    :class="{ 'p-invalid': submitted && !book.inventoryStatus }" />
                                <small class="p-invalid" v-if="submitted && !book.inventoryStatus">{{
                                    $t('Messages.Required.InventoryStatus') }}</small>
                            </div>

                            <div class="formgrid grid">
                                <div class="field col">
                                    <label for="price">{{ $t('Price') }}</label>
                                    <InputNumber id="price" v-model="book.price" mode="currency" currency="IRR"
                                        locale="fa-IR" :class="{ 'p-invalid': submitted && !book.price }"
                                        :required="true" />
                                    <small class="p-invalid" v-if="submitted && !book.price">{{
                                        $t('Messages.Required.Price')
                                    }}</small>
                                </div>
                                <div class="field col">
                                    <label for="quantity">{{ $t('Quantity') }}</label>
                                    <InputNumber id="quantity" v-model="book.quantity" integeronly
                                        :class="{ 'p-invalid': submitted && !book.quantity }" />
                                    <small class="p-invalid" v-if="submitted && !book.quantity">{{
                                        $t('Messages.Required.Quantity') }}</small>
                                </div>
                            </div>

                            <div class="field">
                                <label class="mb-3">{{ $t('Category') }}</label>
                                <div class="formgrid grid">
                                    <div class="field-radiobutton col-6" v-for="  category   in    categories   ">
                                        <RadioButton id="category1" name="category" :value="category.id"
                                            v-model="book.category" />
                                        <label for="category1" class="mx-2">{{ category.name }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="mb-3">{{ $t('Tags') }}</label>
                                <MultiSelect v-model="book.tags" :options="tags" optionLabel="name"
                                    :placeholder="$t('Select.Tags')" :filter="true">
                                    <template #value="slotProps">
                                        <div :class="'inline-flex align-items-center py-1 px-2 bg-primary text-primary border-round ' + setMargin + '2'"
                                            v-for="   option    of    slotProps.value   " :key="option.id">
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
                                <Dropdown v-model="book.writer" :options="writers" optionLabel="name"
                                    :placeholder="$t('Select.Writer')" />
                            </div>

                            <div class="field">
                                <label class="mb-3">{{ $t('Publisher') }}</label>
                                <Dropdown v-model="book.publisher" :options="publishers" optionLabel="name"
                                    :placeholder="$t('Select.Publisher')" />
                            </div>

                            <div class="field">
                                <label class="mb-3">{{ $t('Translator') }}</label>
                                <Dropdown v-model="book.translator" :options="translators" optionLabel="name"
                                    :placeholder="$t('Select.Translator')" />
                            </div>
                        </div>
                        <template #footer>
                            <Button :label="$t('Cancel')" icon="pi pi-times" class="p-button-text" @click="hideDialog" />
                            <Button :label="$t('Save')" icon="pi pi-check" class="p-button-text" @click="saveBook" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteBookDialog" :style="{ width: '450px' }"
                        :header="$t('Confirm') + ' ' + $t('Delete')" :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i v-if="$i18n.locale == 'en'" class="pi pi-exclamation-triangle mr-3"
                                style="font-size: 2rem" />
                            <span v-if="book">{{ $t('Messages.Confirm.Delete', { name: book.name }) }}</span>
                            <i v-if="$i18n.locale == 'fa'" class="pi pi-exclamation-triangle ml-3"
                                style="font-size: 2rem" />
                        </div>
                        <template #footer>
                            <Button :label="$t('No')" icon="pi pi-times" class="p-button-text"
                                @click="deleteBookDialog = false" />
                            <Button :label="$t('Yes')" icon="pi pi-check" class="p-button-text" @click="deleteBook(book)" />
                        </template>
                    </Dialog>

                    <Dialog v-model:visible="deleteBooksDialog" style="width: 450px;"
                        :header="$t('Confirm') + ' ' + $t('Delete')" :modal="true">
                        <div class="flex align-items-center justify-content-center">
                            <i v-if="$i18n.locale == 'en'" class="pi pi-exclamation-triangle mr-3"
                                style="font-size: 2rem" />
                            <span v-if="book">{{ $t('Messages.Confirm.DeleteBooks') }}</span>
                            <i v-if="$i18n.locale == 'fa'" class="pi pi-exclamation-triangle ml-3"
                                style="font-size: 2rem" />
                        </div>
                        <template #footer>
                            <Button :label="$t('No')" icon="pi pi-times" class="p-button-text"
                                @click="deleteBooksDialog = false" />
                            <Button :label="$t('Yes')" icon="pi pi-check" class="p-button-text"
                                @click="deleteSelectedBooks" />
                        </template>
                    </Dialog>
                </div>
            </div>
    </div>
</app-layout></template>
