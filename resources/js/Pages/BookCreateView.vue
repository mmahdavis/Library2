<script setup>
import { ref, watch } from 'vue';
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

const step = ref(1)
const toast = useToast();

const book = ref({});
const statuses = ref([
    { label: 'INSTOCK', value: 'instock' },
    { label: 'LOWSTOCK', value: 'lowstock' },
    { label: 'OUTOFSTOCK', value: 'outofstock' }
]);
const getDirection = ref(locale == 'en' ? 'direction:ltr' : 'direction:rtl');
const getMargin = ref(locale == 'en' ? 'mr-' : 'ml-');


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

const onAdvancedUpload = () => {
    toast.add({ severity: 'info', summary: 'Success', detail: 'File Uploaded', life: 3000 });
};

const next = () => {
    step.value++;
}
const prev = () => {
    step.value--;
}

const submit = () => {
    console.log(':|');
    toast.add({ severity: 'info', summary: 'Success', detail: 'Data Submited', life: 3000 });
}
</script>

<template>
    <Head title="Create Book" />
    <app-layout>
        <Fieldset v-if="step == 1" legend="Book Data" class="card col-12">
            <div class="p-fluid formgrid grid">
                <div class="field col-12">
                    <FileUpload name="demo[]" url="./upload.php" @upload="onAdvancedUpload($event)" :multiple="true"
                        accept="image/*" :maxFileSize="1000000">
                        <template #empty>
                            <p>Drag and drop files to here to upload.</p>
                        </template>
                    </FileUpload>
                </div>
                <div class="field col-12 md:col-6">
                    <label for="name">{{ $t('Name') }}</label>
                    <InputText id="name" v-model.trim="book.name" required="true" autofocus
                        :class="{ 'p-invalid': submitted && !book.name }" />
                    <small class="p-invalid" v-if="submitted && !book.name">{{ $t('Messages.Required.Name')
                    }}</small>
                </div>
                <div class="field col-12 md:col-6">
                    <label for="code">Code</label>
                    <InputText v-model="book.code" id="code" type="text" />
                </div>
                <div class="field col-12 md:col-4">
                    <label for="inventoryStatus" class="mb-3">{{ $t('InventoryStatus') }}</label>
                    <Dropdown id="inventoryStatus" v-model="book.inventoryStatus" :options="statuses" optionLabel="label"
                        :placeholder="$t('Select.Status')" :class="{ 'p-invalid': submitted && !book.inventoryStatus }" />
                    <small class="p-invalid" v-if="submitted && !book.inventoryStatus">{{
                        $t('Messages.Required.InventoryStatus') }}</small>
                </div>
                <div class="field col-12 md:col-4">
                    <label for="quantity">{{ $t('Quantity') }}</label>
                    <InputNumber id="quantity" v-model="book.quantity" integeronly
                        :class="{ 'p-invalid': submitted && !book.quantity }" />
                    <small class="p-invalid" v-if="submitted && !book.quantity">{{
                        $t('Messages.Required.Quantity') }}</small>
                </div>
                <div class="field col-12 md:col-4">
                    <label for="price">{{ $t('Price') }}</label>
                    <InputNumber id="price" v-model="book.price" mode="currency" currency="IRR" locale="fa-IR"
                        :class="{ 'p-invalid': submitted && !book.price }" :required="true" />
                    <small class="p-invalid" v-if="submitted && !book.price">{{
                        $t('Messages.Required.Price')
                    }}</small>
                </div>
                <div class="field col-12 md:col-4">
                    <label class="mb-3">{{ $t('Writer') }}</label>
                    <Dropdown v-model="book.writer" :options="writers" optionLabel="name"
                        :placeholder="$t('Select.Writer')" />
                </div>
                <div class="field col-12 md:col-4">
                    <label class="mb-3">{{ $t('Publisher') }}</label>
                    <Dropdown v-model="book.publisher" :options="publishers" optionLabel="name"
                        :placeholder="$t('Select.Publisher')" />
                </div>
                <div class="field col-12 md:col-4">
                    <label class="mb-3">{{ $t('Translator') }}</label>
                    <Dropdown v-model="book.translator" :options="translators" optionLabel="name"
                        :placeholder="$t('Select.Translator')" />
                </div>
                <div class="field col-12">
                    <label for="description">Description</label>
                    <Textarea v-model="book.description" id="description" rows="4" />
                </div>
            </div>
            <div class="flex justify-content-between">
                <Link :href="route('books.index')"><Button class="" label="Cancel" icon="pi pi-times" iconPos="left" /></Link>
                <Button @click.prevent="next()" class="" label="Next" icon="pi pi-caret-right" iconPos="right" />
            </div>
        </Fieldset>
        <Fieldset v-if="step == 2" legend="Book Data" class="card col-12">
            <div class="p-fluid formgrid grid">
                <div class="field col-12">
                    <Divider class="" align="center" type="dotted">
                        <b>{{ $t('Category') }}</b>
                    </Divider>
                    <div class="mb-3"></div>
                    <TreeSelect id="category" v-model="book.categories" :options="nodes" placeholder="Select Category"
                        class="w-full" />
                </div>

                <div class="field col-12">
                    <Divider align="center" type="dotted">
                        <b>{{ $t('Tags') }}</b>
                    </Divider>
                    <PickList v-model="book.categories" listStyle="height:342px" dataKey="id">
                        <template #sourceheader> Available </template>
                        <template #targetheader> Selected </template>
                        <template #item="slotProps">
                            <div class="flex flex-wrap p-2 align-items-center gap-3">
                                <img class="w-4rem shadow-2 flex-shrink-0 border-round"
                                    :src="'https://primefaces.org/cdn/primevue/images/product/' + slotProps.item.image"
                                    :alt="slotProps.item.name" />
                                <div class="flex-1 flex flex-column gap-2">
                                    <span class="font-bold">{{ slotProps.item.name }}</span>
                                    <div class="flex align-items-center gap-2">
                                        <i class="pi pi-tag text-sm"></i>
                                        <span>{{ slotProps.item.category }}</span>
                                    </div>
                                </div>
                                <span class="font-bold text-900">$ {{ slotProps.item.price }}</span>
                            </div>
                        </template>
                    </PickList>
                </div>

            </div>
            <div class="flex justify-content-between">
                <Button @click.prevent="prev()" class="" label="Back" icon="pi pi-caret-left" iconPos="left" />
                <Button @click.prevent="submit()" class="" label="submit" icon="pi pi-check" iconPos="right" />
            </div>
        </Fieldset>
    </app-layout>
</template>
