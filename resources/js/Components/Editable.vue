<script setup>

import {nextTick, ref} from "vue";

const props = defineProps({
    element: { type: String, default: 'div' },
    modelValue: String,
});
const emit = defineEmits(['update:modelValue']);

let oldValue = null;
const editable = ref(null);

async function edit(e) {
    if (editable.value) {
        return;
    }

    oldValue = props.modelValue;
    editable.value = true;
    await nextTick();
    e.currentTarget.focus();
}

async function commit(e) {
    if (!editable.value) {
        return;
    }

    editable.value = null;
    if (oldValue !== e.currentTarget.innerText) {
        emit('update:modelValue', e.currentTarget.innerText);
    }
    oldValue = null;

    await nextTick();
    e.currentTarget.blur();
}

function cancel(e) {
    if (!editable.value) {
        return;
    }

    editable.value = null;
    e.currentTarget.innerText = oldValue;
    oldValue = null;
}

</script>

<template>
    <component tabindex="0" :is="element" @focus="edit" @blur="commit"
        @keydown.enter.prevent="commit" @keydown.esc.prevent="cancel" :contenteditable="editable"
        class="focus:outline focus:outline-offset-2 focus:outline-blue-500"
    >
        {{ modelValue }}
    </component>
</template>
