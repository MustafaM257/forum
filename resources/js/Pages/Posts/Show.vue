<template>
    <AppLayout :title="post.title">
        <Container>

            <article class="mt-6">
                <h2 class="text-2xl md:text-4xl font-bold tracking-tight text-gray-900 ">{{post.title}}</h2>
                <span class="block mt-1 text-base text-gray-600">{{ dateFormat(post.created_at) }} ago by {{ post.user.name }}</span>
                <p class="mt-5 text-xl text-gray-500">{{post.body}}</p>

            </article>
            <div>
                <ul role="list" class="space-y-10 py-10">
                    <li v-for="(comment, commentIdx) in comments.data" :key="commentIdx.id">
                        <div class="relative pb-8">
                            <span v-if="commentIdx !== comments.data.length - 1" class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true" />
                            <Comment :comment="comment" />
                        </div>
                    </li>
                </ul>
                <Pagination :meta="comments.meta" />
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

const props = defineProps(['post','comments']);
console.log(props.comments);
const dateFormat = (str) => {
    return formatDistance(parseISO(str), new Date());
}

</script>
