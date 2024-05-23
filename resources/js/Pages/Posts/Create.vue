<template>
    <AppLayout title="Create a post">
        <Container>
            <h1 class="text-2xl font-bold">Create a Post</h1>
            <div class="mt-12">
                <form @submit.prevent="createPost" class="space-y-6">
                    <div>
                        <InputLabel for="title" class="sr-only">Title</InputLabel>
                        <TextInput id="title" class="w-full"  v-model="form.title" placeholder="Your title" />
                        <InputError :message="form.errors.title" class="mt-1" />
                    </div>
                    <div>
                        <InputLabel for="body" class="sr-only">Title</InputLabel>
                        <MarkdownEditor v-model="form.body" />
                        <TextArea id="body" class="w-full"  v-model="form.body" rows="20"/>
                        <InputError :message="form.errors.body" class="mt-1" />
                    </div>
                    <div>
                        <PrimaryButton type="submit">Create Post</PrimaryButton>
                    </div>

                </form>
            </div>
            <div>
            </div>
        </Container>

    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import Container from "@/Components/Container.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import TextArea from "@/Components/TextArea.vue";
import MarkdownEditor from "@/Components/MarkdownEditor.vue";
const form = useForm({
    title: '',
    body: '',
})

const createPost = () => {
    form.post(route('posts.store'));
}
</script>
