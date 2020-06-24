<template>
          <div class="row">
            <div class="col-md-4">
                <MoListItem v-on:itemClick="selectItem($event)">Teste</MoListItem>
            </div>
            <div class="col-md-8">
                
            </div>
        </div>
</template>

<script>
import MoListItem from "../molecules/MoListItem.vue";
export default {
        name: "OrSettings",
    components: {
        MoListItem,
    },
    methods: {
        selectItem(item) {
            this.item = item;
            console.log(`Capturado ${this.item}`);
        }
    },
    data() {
        return {
            item: 0
        }
    },
}
</script>

<style>

</style>