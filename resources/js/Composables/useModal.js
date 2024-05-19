import {reactive, readonly} from "vue";

const globalState = reactive({
    show:false,
    title: '',
    message: '',
    resolver:null,
});

export function useModal() {

    const resetModal = () => {
        globalState.show = false
        globalState.title =  ''
        globalState.message= ''
        globalState.resolver= null
    }

    return {
        state: readonly(globalState),
        useModalConfirmation: (message, title="Please Confirm") => {
            globalState.title=title
            globalState.show=true;
            globalState.message = message;
            return new Promise((resolver) => {
                globalState.resolver = resolver;
            })
        },
        confirm: () => {
            if (globalState.resolver) {
                globalState.resolver(true);
            }
        },
        cancel: () => {
            if (globalState.resolver) {
                globalState.resolver(false);
            }
            resetModal();
        }

    }
}
