<template>
  <div class="row">
    <div class="col-md-6">
      <mo-item-crud @newItem="addItem($event)" />
    </div>
    <div class="col-md-6">
      <button
        type="button"
        @click="saveSettings()"
        class="btn btn-danger btn-block"
      >Salvar configurações</button>
    </div>

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
import MoGroupCrud from "../molecules/MoGroupCrud.vue";
import MoItemCrud from "../molecules/MoItemCrud.vue";
export default {
  name: "OrSettings",
  components: {
    MoListItem,
    MoAttributeCrud,
    MoGroupCrud,
    MoItemCrud
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
    addItem(group) {
      //this.itemList.push(group);
      Vue.set(this.settingsObject, "groups", group);
      //Object.assign(this.settingsObject, group)
    },
    saveSettings() {
      const localSettings = this.loadSettings() ? this.loadSettings() : {};
      const newSettings = Object.assign(localSettings, this.settingsObject);
      const saveSettings = JSON.stringify(newSettings);

      localStorage.setItem("settings", saveSettings);

    },
    loadSettings() {
      const localSettings = JSON.parse(localStorage.getItem("settings"));
      return localSettings;
    }
  },
  data() {
    return {
      itemList: {},
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