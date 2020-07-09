<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-header bg-dark text-white">Administração das configurações</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <vue-json-pretty
                :path="'settingsJSON'"
                :data="settingsObject"
                :path-selectable="((path, data) => typeof data !== 'number')"
                @click="treeClick"
                highlightMouseoverNode
                highlightSelectedNode
                selectableType="single"
                v-model="selectedAdmItem"
              ></vue-json-pretty>
            </div>
            <div class="col-md-6">
              <mo-item-crud :item-full="settingsObject" @newItem="addItem($event)" />

              <div class="card">
                <div class="card-header">
                  <span class="ml-2">
                    <i class="fas fa-edit fa-fw"></i>
                  </span> Edição de itens
                </div>
                <div class="card-body">
                  <div v-show="typeof(selectedAdmData) != 'object'">
                    <small>chave</small>

                    <h6 class="text-muted mb-3">
                      <strong>{{selectedAdmPath}}</strong>
                    </h6>
                    <small>valor original</small>
                  </div>

                  <p v-if="typeof(selectedAdmData) != 'object'">
                    <strong>{{ selectedAdmData }}</strong>
                  </p>
                  <p
                    v-else-if="typeof(selectedAdmData) == 'object'"
                  >Selecione uma propriedade do objeto para editar</p>

                  <div v-show="typeof(selectedAdmData) != 'object'" class>
                    <small>
                      <strong>Novo valor</strong>
                    </small>
                    <div v-if="typeof(selectedAdmData) == 'boolean'">
                      <input type="checkbox" id="checkbox" v-model="newSelectedAdmData" />
                    </div>
                    <div v-if="typeof(selectedAdmData) == 'number'">
                      <input
                        type="number"
                        v-model="newSelectedAdmData"
                        class="form-control"
                        @change="propertyChange()"
                        aria-describedby="item_path_help"
                        placeholder
                      />
                    </div>
                    <div v-if="typeof(selectedAdmData) == 'string'">
                      <input
                        type="text"
                        v-model="newSelectedAdmData"
                        class="form-control"
                        @change="propertyChange()"
                        aria-describedby="item_path_help"
                        placeholder
                      />
                    </div>
                  </div>
                </div>
                <div class="card-footer text-muted">
                  <div class="row text-center" v-if="editMode">
                    <div class="col-6">
                      <button
                        type="button"
                        class="btn btn-block btn-outline-secondary mx-auto"
                        @click="dontSaveAdmSettings()"
                      >Desistir</button>
                    </div>
                    <div class="col-6">
                      <button
                        class="btn btn-primary btn-block"
                        @click="saveAdmSettings($event)"
                      >Confirmar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <button
                    type="button"
                    @click="saveSettings()"
                    class="btn btn-danger btn-block"
                  >Salvar configurações</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <hr />
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
import VueJsonPretty from "vue-json-pretty";
export default {
  name: "OrSettings",
  components: {
    MoListItem,
    MoAttributeCrud,
    MoGroupCrud,
    MoItemCrud,
    VueJsonPretty
  },
  mounted() {
    this.settingsObject = Object.assign({}, this.loadSettings());
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
      //console.log(group);
      // console.log(Object.assign(this.settingsObject.groups, group));
      //const newGroup = Object.assign({}, this.settingsObject.groups, group);
      //console.log(newGroup);
      // Vue.set(this.settingsObject, "groups", group);
      //Object.assign(this.settingsObject, group)
      const vm = this;

      if (vm.settingsObject.groups) {
        Object.keys(group).forEach(function(key) {
          Vue.set(vm.settingsObject.groups, key, group[key]);
        });
      } else {
        Vue.set(vm.settingsObject, "groups", group);
      }
    },
    saveSettings() {
      const localSettings = this.loadSettings() ? this.loadSettings() : {};
      const newSettings = Object.assign(localSettings, this.settingsObject);
      const saveSettings = JSON.stringify(newSettings);

      localStorage.setItem("settings", saveSettings);
    },
    setValue(path, value) {
      let obj = this;
      const parts = path.split(".");
      while (parts.length > 1 && obj.hasOwnProperty(parts[0])) {
        obj = obj[parts.shift()];
        
      }
      console.log(obj[parts[0]]);
      obj[parts[0]] = value;
      
    },
    saveAdmSettings(event) {
      const key = this.selectedAdmPath.replace("settingsJSON.", "");
      //console.log(key);
      //this.setValue(key, this.newSelectedAdmData);
      _.set(this.settingsObject, key, this.newSelectedAdmData)
      //const vm = this;
      //this.settingsObject.$set(key, this.newSelectedAdmData)
      //console.log(vm.settingsObject.$set(key, this.newSelectedAdmData));

      //Vue.set(this.settingsObject, key, this.newSelectedAdmData);
    },
    dontSaveAdmSettings() {
      this.editMode = false;
      this.newSelectedAdmData = null;
    },
    propertyChange() {
      this.editMode = true;
    },
    loadSettings() {
      const localSettings = JSON.parse(localStorage.getItem("settings"));
      return localSettings;
    },
    treeClick(path, data) {
      this.selectedAdmData = data;
      this.selectedAdmPath = path;
      this.newSelectedAdmData = null;
      this.editMode = false;
    }
  },
  watch: {
    newSelectedAdmData(newValue, oldValue) {
      if (newValue) {
        this.editMode = true;
      }
    }
  },
  data() {
    return {
      itemList: {},
      settingsObject: {},
      selectedAdmItem: null,
      selectedAdmData: null,
      selectedAdmPath: null,
      newSelectedAdmData: null,
      editMode: false,
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