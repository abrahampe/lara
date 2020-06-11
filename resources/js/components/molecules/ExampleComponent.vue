<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card  px-3">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        <at-loader :loading="globalLoading"></at-loader>
                        <strong>{{ hello.hello }}</strong>
                        <strong>{{
                            $t("validation.accepted", { attribute: "test" })
                        }}</strong>
                    </div>
                    <hr />
                    <notification-test></notification-test>
                    <h5 class="mute mb-0 pb-1">Choose a theme below</h5>
                    <mo-theme-selector
                    variant="primary"
                     class="mb-3"
                        :temas="globalThemes"
                    ></mo-theme-selector>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import AtLoader from "../atoms/AtLoader.vue";
import MoThemeSelector from "../molecules/MoThemeSelector.vue";
import NotificationTest from "../molecules/NotificationTest.vue";
const temas = {
    flatly: "https://bootswatch.com/4/flatly/bootstrap.min.css",
    materia: "https://bootswatch.com/4/materia/bootstrap.min.css",
    solar: "https://bootswatch.com/4/solar/bootstrap.min.css"
};
export default {
    //php phpDocumentor.phar -d . -t docs/api
    name: "ExampleComponent",
    components: {
        AtLoader,
        MoThemeSelector,
        NotificationTest
    },
    mounted() {
        this.getHello();
    },
    data() {
        return {
            ip: "",
        };
    },
    computed: {
        ...mapState(["globalLoading", "hello", "globalThemes"])
    },
    methods: {
        ...mapActions({
            getHello: "getHello"
        })
    }
};
</script>
