<script setup>

import {nextTick, ref} from "vue";
import { marked } from 'marked';
import DOMPurify from 'dompurify';

const props = defineProps({
    modelValue: String,
});
const emit = defineEmits(['update:modelValue']);

const code = ref(null);

let oldValue = null;
const editable = ref(false);

async function edit() {
    if (editable.value) {
        return;
    }

    oldValue = props.modelValue;
    editable.value = true;
    await nextTick();
    code.value.focus();

    let range = document.createRange();
    range.selectNodeContents(code.value);
    range.collapse(false);

    let sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
}

function commit() {
    if (!editable.value) {
        return;
    }

    editable.value = false;
    if (oldValue !== code.value.innerText) {
        emit('update:modelValue', code.value.innerText);
    }
    oldValue = null;
}

function cancel() {
    if (!editable.value) {
        return;
    }

    editable.value = false;
    code.value.innerText = oldValue;
    oldValue = null;
}

function tab() {
    let range = window.getSelection().getRangeAt(0);

    let tabNode = document.createTextNode("\u00a0\u00a0\u00a0\u00a0");
    range.insertNode(tabNode);

    range.setStartAfter(tabNode);
    range.setEndAfter(tabNode);
}
</script>

<template>
    <div tabindex="0" v-if="!editable" v-html="DOMPurify.sanitize(marked(modelValue))" @focus="edit"
         class="prose prose-slate max-w-none dark:prose-invert dark:text-slate-400 prose-headings:scroll-mt-28 prose-headings:font-display prose-headings:font-normal lg:prose-headings:scroll-mt-[8.5rem] prose-lead:text-slate-500 dark:prose-lead:text-slate-400 prose-a:font-semibold dark:prose-a:text-sky-400 prose-a:no-underline prose-a:shadow-[inset_0_-2px_0_0_var(--tw-prose-background,#fff),inset_0_calc(-1*(var(--tw-prose-underline-size,4px)+2px))_0_0_var(--tw-prose-underline,theme(colors.sky.300))] hover:prose-a:[--tw-prose-underline-size:6px] dark:[--tw-prose-background:theme(colors.slate.900)] dark:prose-a:shadow-[inset_0_calc(-1*var(--tw-prose-underline-size,2px))_0_0_var(--tw-prose-underline,theme(colors.sky.800))] dark:hover:prose-a:[--tw-prose-underline-size:6px] prose-pre:rounded-xl prose-pre:bg-slate-900 prose-pre:shadow-lg dark:prose-pre:bg-slate-800/60 dark:prose-pre:shadow-none dark:prose-pre:ring-1 dark:prose-pre:ring-slate-300/10 dark:prose-hr:border-slate-800">
    </div>
    <div v-else contenteditable @blur="commit" ref="code"
         @keydown.ctrl.enter.prevent="commit" @keydown.esc.prevent="cancel"
         @keydown.tab.prevent="tab"
         class="outline outline-offset-1 outline-blue-500"
     >
        <code class="whitespace-pre focus:outline-0">{{ modelValue }}</code>
    </div>
</template>
