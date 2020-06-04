import * as typos from './mutation-types';
import { emptyState } from './state';

export default {
    [typos.RESET_STATE](state) {
        const newState = emptyState();
        Object.keys(state).forEach(key => {
            Object.assign(state[key], newState[key]);
        });
        console.log(newState());
        Object.assign(state, newState());
    },
    [typos.SET_LOADING](state, payload) {
        state.globalLoading = payload;
    },
    [typos.REMOVE_ERROR](state) {
        state.error = null;
    },
    [typos.SET_HELLO](state, payload) {
        state.hello = payload;
    }
};
