<template>

<!--                    Comment Data-->
                    <div class="relative flex items-start space-x-3 ">
                            <div class="relative">
                                <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" :src="comment.user.profile_photo_url" alt="" />

                                <span class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div>
                                    <div class="text-sm">
                                    </div>
                                    <p class="mt-0.5 text-sm text-gray-500">Commented by {{comment.user.name}} <span class="font-bold"> {{ dateFormat(comment.created_at)}} ago </span></p>
                                </div>
                                <div class="mt-2 text-sm text-gray-700 break-all">
                                    <p>{{ comment.body }}</p>
                                </div>
                            </div>
                        <div class="mt-4 space-y-4">
                            <form
                                v-if="comment.can?.update"
                                @submit.prevent="$emit('edit',comment.id)">
                                <button class="text-gray-600 font-mono text-sm bg-gray-200 py-2 px-3 hover:text-gray-800 hover:brightness-105 transition-all hover:font-semibold w-full">Edit</button>
                            </form>
                            <form
                                v-if="comment.can?.delete"
                                @submit.prevent="$emit('delete',comment.id)">
                                <button class="text-red-600 font-mono text-sm bg-red-200 py-2 px-3 hover:text-red-800 hover:brightness-105 transition-all hover:font-semibold w-full">Delete</button>
                            </form>
                        </div>
                    </div>
<!--                    End of Comment Data-->

</template>

<script setup>
import {formatDistance, parseISO} from "date-fns";
import {router, usePage} from "@inertiajs/vue3"
import {computed} from "vue";
const props = defineProps(['comment'])
const emit = defineEmits(['delete','edit']);
const dateFormat = (str) => {
    return formatDistance(parseISO(str), new Date());
}

// Refactor the isCommentOwner to be sent from backend, check CommentResource that used CommentPolicy to make that work, much better.
// const isCommentOwner = computed(() => {
//     return props.comment.user.id === usePage().props.auth.user?.id;
// })
</script>
