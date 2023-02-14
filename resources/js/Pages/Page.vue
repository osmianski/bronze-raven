<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Editable from "@/Components/Editable.vue";
import axios from "axios";
import EditableMarkdown from "@/Components/EditableMarkdown.vue";

const props = defineProps({
    page: Object,
});

function update(column) {
    const request = {
        method: 'post',
        baseURL: 'http://127.0.0.1:8000',
        url: '/_pages',
        params: {
            id: props.page.id,
        },
        data: {},
    };

    request.data[column] = props.page[column];

    axios(request).catch(function (error) {
        console.log(error);
    });;
}
</script>

<template>
    <Head :title="page.title" />

    <div class="relative mx-auto flex max-w-8xl justify-center sm:px-2 lg:px-8 xl:px-12">
        <main class="min-w-0 max-w-2xl flex-auto px-4 py-16 lg:max-w-none lg:pr-0 lg:pl-8 xl:px-16">
            <article>
                <header class="mb-9 space-y-1">
                    <Editable v-model="page.title" @update:model-value="update('title')"
                        element="h1" class="font-display text-3xl tracking-tight text-slate-900 dark:text-white" />
                </header>

                <EditableMarkdown v-model="page.body" @update:model-value="update('body')" />
            </article>
        </main>
    </div>
</template>
