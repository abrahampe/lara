<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                       {{getAllCategory}} I'm an example component. 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        //php phpDocumentor.phar -d . -t docs/api
        mounted() {
            this.$store.dispatch("allCategoryFromDatabase")
            console.log('Component started from vuex.')

        },
        data() {
            return {
                ip: '',
            }
        },
        computed: {
        getAllCategory(){ //final output from here
            return this.$store.getters.getCategoryFormGetters
        }
      },
    }
</script>
