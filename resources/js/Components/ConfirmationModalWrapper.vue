<template>
    <ConfirmationModal :show="state.show">
        <template #title>
            {{state.title}}
        </template>
        <template #content>
            {{state.message}}
        </template>
        <template #footer>
            <PrimaryButton @click="confirm">Confirm</PrimaryButton>
            <SecondaryButton ref="cancelBtn" @click="cancel">Cancel</SecondaryButton>
        </template>
    </ConfirmationModal>
</template>
<script setup lang="ts">
import {useModal} from '@/Composables/useModal';
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {nextTick, ref, watchEffect} from "vue";
const {state , confirm , cancel} = useModal();
const cancelBtn = ref(null);
watchEffect(async()=> {
    if(state.show) {
        await nextTick();
        // To keep focus on the cancel button when the modal opens
        cancelBtn.value?.$el.focus();
    }
})

</script>
