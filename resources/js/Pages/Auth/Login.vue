<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const logoUrl = computed(() => {
    return `/layout/images/logo.png`;
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

</script>

<template>
    <Head title="Login" />
    <div class="surface-ground flex align-items-center justify-content-center min-h-screen min-w-screen overflow-hidden">
        <div class="flex flex-column align-items-center justify-content-center">
            <div
                style="border-radius: 56px; padding: 0.3rem; background: linear-gradient(180deg, var(--primary-color) 10%, rgba(33, 150, 243, 0) 30%)">
                <div class="relative w-full surface-card py-8 px-5 sm:px-8" style="border-radius: 53px">
                    <div class="text-center mb-5">
                        <img :src="logoUrl" alt="Image" height="50" class="mb-3" />
                        <div class="text-900 text-3xl font-medium mb-3">{{ $t('Login.Header') }}</div>
                        <span class="text-600 font-medium">{{ $t('Login.Message') }}</span>
                    </div>

                    <form @submit.prevent="submit">
                        <div>
                            <label for="email" class="block text-900 text-xl font-medium mb-2">{{ $t('Email') }}</label>
                            <InputText id="email" type="text" :placeholder="$t('Placeholder.Email')" class="w-full md:w-30rem mb-5"
                                style="padding: 1rem" v-model="form.email" />

                            <label for="password" class="block text-900 font-medium text-xl mb-2">{{ $t('Password') }}</label>
                            <Password id="password" v-model="form.password" :placeholder="$t('Placeholder.Password')" :toggleMask="true"
                                class="w-full mb-3" inputClass="w-full" inputStyle="padding:1rem" :feedback="false">
                            </Password>

                            <div class="flex align-items-center justify-content-between mb-5 gap-5">
                                <div class="flex align-items-center">
                                    <Checkbox v-model="form.checked" id="rememberme1" binary class="mr-2"></Checkbox>
                                    <label for="rememberme1">{{ $t('RememberMe') }}</label>
                                </div>
                                <a class="font-medium no-underline ml-2 text-right cursor-pointer"
                                    style="color: var(--primary-color)">{{ $t('ForgotPassword') }}?</a>
                            </div>
                            <Button type="submit" :label="$t('SignIn')" class="w-full p-3 text-xl"
                                :disabled="form.processing"></Button>
                            <Link :href="route('register')">
                            <Button type="submit" :label="$t('NewMember')" class="w-full p-3 text-xl mt-3"
                                :disabled="form.processing" outlined></Button>
                            </Link>
                        </div>
                    </form>
                    <SelectButton class="absolute bottom-0" v-model="$i18n.locale" :options="$i18n.availableLocales" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.pi-eye {
    transform: scale(1.6);
    margin-right: 1rem;
}

.pi-eye-slash {
    transform: scale(1.6);
    margin-right: 1rem;
}
</style>
