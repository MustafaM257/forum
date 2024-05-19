import {reactive, readonly} from "vue";

const globalState = reactive({
    show:false,
    title: '',
    message: '',
});

export function useModal() {

    return {
        state: readonly(globalState),
        useModalConfirmation: (message) => {
            globalState.title="Please confirm"
            globalState.show=true;
            globalState.message = message;

        }
    }
}
