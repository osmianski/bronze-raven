<script setup>
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    page: Object,
});
</script>

<template>
    <Head :title="page.title" />

    <div class="relative mx-auto flex max-w-8xl justify-center sm:px-2 lg:px-8 xl:px-12">
        <main class="min-w-0 max-w-2xl flex-auto px-4 py-16 lg:max-w-none lg:pr-0 lg:pl-8 xl:px-16">
            <article>
                <header class="mb-9 space-y-1">
                    <h1 class="font-display text-3xl tracking-tight text-slate-900 dark:text-white">
                        {{ page.title }}
                    </h1>
                </header>
                <div>
                    {{ page.body }}
                </div>
            </article>
        </main>
    </div>
</template>
