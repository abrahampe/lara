<template>
  <div class="row">
    <div class="col-md-4">
      <mo-list-item :item-list="settingsObject.groups" @itemClick="selectItem($event)">Teste</mo-list-item>
    </div>
    <div class="col-md-8">
      <mo-attribute-crud :fullSettings="settingsObject" :selected-parent="selectedItem" :default-info="defaultSelected"></mo-attribute-crud>
         <div class="text-right">
        <button class="mt-3 btn btn-success"
        @click="saveSettings()"
        >
          <i class="fas fa-save fa-fw"></i> Gravar configurações
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import MoListItem from "../molecules/MoListItem.vue";
import MoAttributeCrud from "../molecules/MoAttributeCrud.vue";
import axios from 'axios';

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
    },
      saveSettings() {
      const localSettings = this.loadSettings() ? this.loadSettings() : {};
      const newSettings = Object.assign(localSettings, this.settingsObject);
      const saveSettings = JSON.stringify(newSettings);

      localStorage.setItem("settings", saveSettings);


  axios.post('/sett/save',  this.settingsObject)
            .then(function(response) {
              console.log(response);
            })
            .catch(function(error) {
              console.log(error);
            });

    },
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