<template>
    <div>
        <EditorContent :editor="editor" />
    </div>
</template>

<script setup lang="ts">
import { EditorContent, useEditor } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import { watch } from "vue";

// Define props and emit
// const props = defineProps<{
//     modelValue: string;
// }>();

const props = defineProps({
    modelValue: {
        default: '',
    },
});
const emit = defineEmits(['update:modelValue']);

// Initialize editor with Tiptap
const editor = useEditor({
    extensions: [StarterKit],
    onUpdate({ editor }) {
        emit('update:modelValue', editor.getHTML());
    },
});

// Watch for changes in modelValue and update editor content
watch(
    () => props.modelValue,
    (value) => {
        if (value !== editor.value?.getHTML()) {
            editor.value?.commands.setContent(value);
        }
    },
    { immediate: true }
);
</script>
