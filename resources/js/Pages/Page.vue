<script setup>
import {Head, usePage} from '@inertiajs/vue3';
import Editable from "@/Components/Editable.vue";
import axios from "axios";
import EditableMarkdown from "@/Components/EditableMarkdown.vue";
import { watch } from 'vue';

const props = defineProps({
    page: Object,
});

const editablePageProps = ['title', 'body'];

function updatePageProperty(property, value, filter) {
    const request = {
        method: 'post',
        baseURL: usePage().props.baseUrl,
        url: '/_pages',
        params: filter,
        data: {},
    };

    request.data[property] = value;

    axios(request).catch(function (error) {
        console.log(error);
    });
}

editablePageProps.forEach(property => {
    watch(() => props.page[property], value =>
        updatePageProperty(property, value, { id: props.page.id}));
});

Echo.channel(`pages`).listen('.PageUpdated', (e) => {
    if (e.model.id === props.page.id) {
        Object.assign(props.page, e.model);
    }
});
</script>

<template>
    <Head :title="page.title" />

    <div class="relative mx-auto flex max-w-8xl justify-center sm:px-2 lg:px-8 xl:px-12">
        <main class="min-w-0 max-w-2xl flex-auto px-4 py-16 lg:max-w-none lg:pr-0 lg:pl-8 xl:px-16">
            <article>
                <header class="mb-9 space-y-1">
                    <Editable v-model="page.title"
                        element="h1" class="font-display text-3xl tracking-tight text-slate-900 dark:text-white" />
                </header>

                <EditableMarkdown v-model="page.body" />
            </article>
        </main>
    </div>
</template>
