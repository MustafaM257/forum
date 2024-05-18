<template>
    <AppLayout :title="post.title">
        <Container>

            <article class="mt-6">
                <h2 class="text-2xl md:text-4xl font-bold tracking-tight text-gray-900 ">{{post.title}}</h2>
                <span class="block mt-1 text-base text-gray-600">{{ dateFormat(post.created_at) }} ago by {{ post.user.name }}</span>
                <p class="mt-5 text-xl text-gray-500">{{post.body}}</p>

            </article>
            <div class="mt-12">
                <form @submit.prevent="addComment">
                    <div>
                        <InputLabel for="body">Comment</InputLabel>
                        <TextInput id="body" v-model:="comment_form.body"/>
                    </div>

                    <PrimaryButton type="submit" class="mt-4">Add Comment</PrimaryButton>
                </form>
            </div>
            <div>
                <ul role="list" class="space-y-10 py-10">
                    <li v-for="(comment, commentIdx) in comments.data" :key="commentIdx.id">
                        <div class="relative pb-8">
                            <span v-if="commentIdx !== comments.data.length - 1" class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true" />
                            <Comment :comment="comment" />
                        </div>
                    </li>
                </ul>
                <Pagination :meta="comments.meta" :only="['comments']" />
            </div>
        </Container>

    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {computed} from "vue";
import {formatDistance, parseISO} from "date-fns";
import Container from "@/Components/Container.vue";
import Pagination from "@/Components/Pagination.vue";
import Comment from "@/Components/Comment.vue";
import {ChatBubbleLeftEllipsisIcon} from "@heroicons/vue/20/solid/index.js";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps(['post','comments']);
console.log(props.comments);
const dateFormat = (str) => {
    return formatDistance(parseISO(str), new Date());
}
const comment_form = useForm({
    body: '',
})

const addComment = () => {
    comment_form.post(route('posts.comments.store',props.post.id),{
        preserveScroll: true,
    });
}

</script>
