<template>
    <div class=" bg-white  w-full  border-0  text-black  focus:ring-0 sm:text-sm sm:leading-6">
        <menu class="flex divide-x border-b">
            <li>
                <button
                    @click="() => editor.chain().focus().toggleBold().run()"
                    type="button" class="px-3 py-2 hover:bg-gray-300 rounded-tl-md" title="bold">
                    <i class="ri-bold"></i>
                </button>
            </li>
            <li>
                <button type="button" class="px-3 py-2 hover:bg-gray-300 " title="italic">
                    <i class="ri-italic"></i>
                </button>
            </li>
        </menu>
        <EditorContent :editor="editor" />
    </div>
</template>

<script setup lang="ts">
import { EditorContent, useEditor } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import { watch } from "vue";
import {Markdown} from "tiptap-markdown";
import 'remixicon/fonts/remixicon.css'
const props = defineProps({
    modelValue: {
        default: '',
    },
});
const emit = defineEmits(['update:modelValue']);

// Initialize editor with Tiptap
const editor = useEditor({
    extensions: [StarterKit,Markdown],
    onUpdate() {
        emit('update:modelValue', editor.value?.storage.markdown.getMarkdown());
    },
    editorProps: {
        attributes: {
            class: 'h-96 prose prose-sm sm:prose-base lg:prose-lg xl:prose-2xl m-5 focus:outline-none py-1.5 px-3 text-black',
        },
    }
});

// Watch for changes in modelValue and update editor content
watch(
    () => props.modelValue,
    (value) => {
        if (value !== editor.value?.storage.markdown.getMarkdown()) {
            editor.value?.commands.setContent(value);
        }
    },
    { immediate: true }
);
</script>
