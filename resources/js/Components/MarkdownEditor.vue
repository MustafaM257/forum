<template>
    <div v-if="editor" class=" bg-white  w-full  border-0  text-black  focus:ring-0 sm:text-sm sm:leading-6">
        <menu class="flex divide-x border-b">
            <li>
                <button
                    @click="() => editor.chain().focus().toggleBold().run()"
                    :class="{
                        'bg-indigo-500 text-white' : editor.isActive('bold'),
                        'hover:bg-gray-300' : !editor.isActive('bold')
                    }"
                    type="button"
                    class="px-3 py-2  rounded-tl-md"
                    title="bold">
                    <i class="ri-bold"></i>
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleItalic().run()"
                    :class="{
                        'bg-indigo-500 text-white' : editor.isActive('italic'),
                        'hover:bg-gray-300' : !editor.isActive('italic')
                    }"
                    type="button"
                    class="px-3 py-2  rounded-tl-md"
                    title="italic">
                    <i class="ri-italic"></i>
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleStrike().run()"
                    :class="{
                        'bg-indigo-500 text-white' : editor.isActive('strike'),
                        'hover:bg-gray-300' : !editor.isActive('strike')
                    }"
                    type="button"
                    class="px-3 py-2  rounded-tl-md"
                    title="italic">
                    <i class="ri-strikethrough"></i>
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleBlockquote().run()"
                    :class="{
                        'bg-indigo-500 text-white' : editor.isActive('blockquote'),
                        'hover:bg-gray-300' : !editor.isActive('blockquote')
                    }"
                    type="button"
                    class="px-3 py-2  rounded-tl-md"
                    title="black quote">
                    <i class="ri-double-quotes-r"></i>
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleBulletList().run()"
                    :class="{
                        'bg-indigo-500 text-white' : editor.isActive('bulletList'),
                        'hover:bg-gray-300' : !editor.isActive('bulletList')
                    }"
                    type="button"
                    class="px-3 py-2  rounded-tl-md"
                    title="bullet list">
                    <i class="ri-list-unordered"></i>
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleOrderedList().run()"
                    :class="{
                        'bg-indigo-500 text-white' : editor.isActive('orderedList'),
                        'hover:bg-gray-300' : !editor.isActive('orderedList')
                    }"
                    type="button"
                    class="px-3 py-2  rounded-tl-md"
                    title="ordered list">
                    <i class="ri-list-ordered"></i>
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleHeading({level: 2}).run()"
                    :class="{
                        'bg-indigo-500 text-white' : editor.isActive('heading', {level : 2}),
                        'hover:bg-gray-300' : !editor.isActive('heading', {level : 2})
                    }"
                    type="button"
                    class="px-3 py-2  rounded-tl-md"
                    title="Heading 1">
                    <i class="ri-h-1"></i>
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleHeading({level: 3}).run()"
                    :class="{
                        'bg-indigo-500 text-white' : editor.isActive('heading', {level : 3}),
                        'hover:bg-gray-300' : !editor.isActive('heading', {level : 3})
                    }"
                    type="button"
                    class="px-3 py-2  rounded-tl-md"
                    title="Heading 2">
                    <i class="ri-h-2"></i>
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleHeading({level: 4}).run()"
                    :class="{
                        'bg-indigo-500 text-white' : editor.isActive('heading', {level : 4}),
                        'hover:bg-gray-300' : !editor.isActive('heading', {level : 4})
                    }"
                    type="button"
                    class="px-3 py-2  rounded-tl-md"
                    title="Heading 3">
                    <i class="ri-h-3"></i>
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
    editorClass: {
        default: '',
    }
});
const emit = defineEmits(['update:modelValue']);

// Initialize editor with Tiptap
const editor = useEditor({
    extensions:
        [
            StarterKit.configure({
                heading: {
                    levels: [2,3,4]
                }
            }),
            Markdown
        ],
    onUpdate() {
        emit('update:modelValue', editor.value?.storage.markdown.getMarkdown());
    },
    editorProps: {
        attributes: {
            class: `   prose prose-sm sm:prose-base lg:prose-lg xl:prose-2xl m-5 focus:outline-none py-1.5 px-3 text-black  ${props.editorClass}`,
        },
    }
});

defineExpose({
    focus: () => editor.value.commands.focus()
})

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
