<template>
    <AppLayout :title="post.title">
        <Container>

            <article class="mt-6">
                <h2 class="text-2xl md:text-4xl font-bold tracking-tight text-gray-900 ">{{post.title}}</h2>
                <span class="block mt-1 text-base text-gray-600">{{ dateFormat(post.created_at) }} ago by {{ post.user.name }}</span>
                <p class="mt-5 text-xl text-gray-500">{{post.body}}</p>

            </article>
            <div class="mt-12">
                <form @submit.prevent=" () => commentIdBeingEdited ? updateComment() : addComment()" v-if="$page.props.auth.user">
                    <div>
                        <InputLabel for="body" class="sr-only">Comment</InputLabel>
                        <TextArea ref="commentTextArea" id="body" rows="5"  v-model="comment_form.body" placeholder="Share your thoughts about this post"/>
                        <InputError :message="comment_form.errors.body"  class="mt-2 text-center"/>
                    </div>

                    <PrimaryButton type="submit" class="mt-4" :disabled="comment_form.processing"
                    v-text="commentIdBeingEdited ? 'Update Comment' : 'Add Comment'"></PrimaryButton>
                    <SecondaryButton @click="cancelEditComment" v-if="commentIdBeingEdited">Cancel</SecondaryButton>
                </form>
            </div>
            <div>
                <ul role="list" class="space-y-10 py-10">
                    <li v-for="(comment, commentIdx) in comments.data" :key="commentIdx">
                        <div class="relative pb-8">
                            <span v-if="commentIdx !== comments.data.length - 1" class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true" />
                            <Comment @edit="editComment" @delete="deleteComment" :comment="comment" />
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
import {router, useForm} from "@inertiajs/vue3";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useModal} from "@/Composables/useModal.js";
const props = defineProps(['post','comments']);
const {useModalConfirmation} = useModal();

const dateFormat = (str) => {
    return formatDistance(parseISO(str), new Date());
}
const comment_form = useForm({
    body: '',
})
const commentTextArea = ref(null);

const addComment = () => {
    comment_form.post(route('posts.comments.store',props.post.id),{
        preserveScroll: true,
        onSuccess: () => comment_form.reset()
    });
}
const updateComment = async () => {
    if (!await useModalConfirmation('Are you sure want to update this comment ?')) {
        // ********* DOuble check tomorrow why not focusing
        commentTextArea.value?.focus();
        return;
    }
    comment_form.put(route('comments.update', {
        comment: commentIdBeingEdited.value,
        page: props.comments.meta.current_page,
    }), {
        preserveScroll: true,
        onSuccess: cancelEditComment,
    })
}
const deleteComment = async (commentId) => {
    if (! await useModalConfirmation('Are you sure want to delete this comment')) { return; }
    router.delete(route('comments.destroy',{
        comment: commentId,
        page: props.comments.meta.current_page,
    }),{
        preserveScroll: true,
    });
}
const commentIdBeingEdited = ref(null);
const commentBeingEdited = computed(() => props.comments.data.find(comment => comment.id === commentIdBeingEdited.value));

const editComment = (commentId) => {
    commentIdBeingEdited.value = commentId;
    comment_form.body = commentBeingEdited.value?.body || '';
    commentTextArea.value?.focus();
}
const cancelEditComment = () => {
    commentIdBeingEdited.value = null;
    comment_form.reset();
}
</script>
