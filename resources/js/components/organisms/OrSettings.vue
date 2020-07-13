<template>
  <div class="row">
    <div class="col-md-4">
      <mo-list-item :item-list="settingsObject.groups" @itemClick="selectItem($event)">Teste</mo-list-item>
    </div>
    <div class="col-md-8">
      <mo-attribute-crud :selected-parent="selectedItem" :default-info="defaultSelected"></mo-attribute-crud>
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
    this.settingsObject = Object.assign({}, this.loadSettings());
    const groups = this.settingsObject.groups;
    const firstObject = Object.values(groups)[0];

    if (firstObject) {
      this.selectedItem = Object.assign({}, firstObject);
    }
  },
  methods: {
    selectItem(item) {
      this.selectedItem = item;
    },
    loadSettings() {
      const localSettings = JSON.parse(localStorage.getItem("settings"));
      return localSettings;
    }
  },

  data() {
    return {
      settingsObject: {},

      selectedItem: {},
      defaultSelected: {
        icon: "fab fa-angellist",
        description: "Sem grupos de configuração",
        items: {}
      }
    };
  }
};
</script>

<style>
</style>