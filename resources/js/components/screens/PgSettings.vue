<template>
    <div class="container mt-5 pt-5">
<at-loader :loading="true"></at-loader>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import AtLoader from "../atoms/AtLoader.vue";

export default {
    //php phpDocumentor.phar -d . -t docs/api
    name: "PgSettings",
    components: {
        AtLoader,
    },
    data() {
        return {
            ip: "",
        };
    },
    computed: {
        ...mapState(["globalLoading"])
    },
    methods: {
        ...mapActions({
            getHello: "getHello"
        })
    }
};
</script>
