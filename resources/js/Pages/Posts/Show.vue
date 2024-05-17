<template>
    <AppLayout :title="post.title">
        <Container>
            <h1 class="text-2xl font-bold">{{ post.title }}</h1>
            <span class="block mt-1 text-sm text-gray-600">{{ postDate }} ago by {{ post.user.name }}</span>

            <article class="mt-6">
                <pre class="whitespace-pre-wrap font-sans">{{ post.body }}</pre>
            </article>
            <hr />
            <div>
                <h1 class="text-5xl">Comments</h1>
                <ul class="space-y-10">
                    <div class="bg-black/50 h-1 w-full" />

                    <li v-for="comment in comments.data">
                        {{comment.body}} <code> By {{comment.user.name}}</code>
                        <br>
                        <p>{{dateFormat(comment.created_at)}}</p>
                        <div class="bg-black/50 h-1 w-full" />

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

const props = defineProps(['post','comments']);
console.log(props.comments);
const postDate = computed(() => formatDistance(parseISO(props.post.created_at), new Date()));
const dateFormat = (str) => {
    return formatDistance(parseISO(str),new Date());
}
</script>
