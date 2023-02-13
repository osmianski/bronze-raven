<script setup>

import {nextTick, ref} from "vue";

const props = defineProps({
    element: { type: String, default: 'div' },
    modelValue: String,
});
const emit = defineEmits(['update:modelValue']);

let oldValue = null;
const editable = ref(false);

async function edit(e) {
    if (editable.value) {
        return;
    }

    oldValue = props.modelValue;
    editable.value = true;
    await nextTick();
    e.currentTarget.focus();
}

function commit(e) {
    if (!editable.value) {
        return;
    }

    editable.value = false;
    oldValue = null;
    emit('update:modelValue', e.currentTarget.innerText);
}

function cancel(e) {
    if (!editable.value) {
        return;
    }

    editable.value = false;
    e.currentTarget.innerText = oldValue;
    oldValue = null;
}

</script>

<template>
    <component :is="element" @click="edit" @blur="commit"
        @keydown.enter.prevent="commit" @keydown.esc.prevent="cancel" :contenteditable="editable"
        class="focus:outline focus:outline-offset-2 focus:outline-blue-500"
    >
        {{ modelValue }}
    </component>
</template>
