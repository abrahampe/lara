<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
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
            console.log('Component started.')
            axios.get(
    'http://www.mocky.io/v2/5ed7144932000035002744d0'
).then((response) => {
       console.log('Component new axios.')
    console.log(response);
    return Promise.resolve();
});
        }
    }
</script>
