<template>
    <div class="container mt-5 pt-5">

<at-loader :loading="false"></at-loader>
<or-settings></or-settings>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import AtLoader from "../atoms/AtLoader.vue";
import OrSettings from "../organisms/OrSettings.vue";

export default {
    //php phpDocumentor.phar -d . -t docs/api
    name: "PgSettings",
    components: {
        OrSettings,
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
