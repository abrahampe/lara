<template>
  <div class="row">
    <div class="col-md-4">
      <mo-list-item :item-list="itemList" @itemClick="selectItem($event)">Teste</mo-list-item>

      <button class="btn btn-outline-primary text-left btn-block my-3"
      @click="addItem"
      >
        <i class="fa-fw fas fa-plus"></i>
        Adicionar Grupo
      </button>
    </div>
    <div class="col-md-8">
      <mo-attribute-crud 
      :selected-parent="selectedItem" 
      :default-info="defaultSelected">
      </mo-attribute-crud>
    </div>
  </div>
</template>

<script>
import MoListItem from "../molecules/MoListItem.vue";
import MoAttributeCrud from "../molecules/MoAttributeCrud.vue";
export default {
  name: "OrSettings",
  components: {
    MoListItem,
    MoAttributeCrud
  },
  mounted() {
    if (this.itemList.length > 0) {
      this.selectedItem = Object.assign({}, this.itemList[0]);
    } else {
    }
  },
  methods: {
    selectItem(item) {
      this.selectedItem = item;
      console.log(`Capturado ${this.item}`);
    },
    addItem() {
     const newItem =  {
          icon: "fas fa-plus",
          description: "Novo grupo"
        }
         this.selectedItem = newItem;
      this.$emit('newItem', newItem);
    }
  },
  data() {
    return {
      itemList: [
        {
          icon: "fab fa-angellist",
          description: "Primeiro grupo"
        },
        {
          icon: "fas fa-camera",
          description: "Secondo grupo"
        },
        {
          icon: "fas fa-chart-bar",
          description: "terceiro grupo"
        },
        {
          icon: "fas fa-chart-line",
          description: "Quarto grupo"
        }
      ],
      selectedItem: {},
      defaultSelected: {
        icon: "fab fa-angellist",
        description: "Sem grupos de configuração"
      }
    };
  }
};
</script>

<style>
</style>