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
              <mo-item-crud
                :selected-item="selectedAdmItem"
                :item-full="settingsObject"
                @newItem="addItem($event)"
              />

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
                        v-model.number="newSelectedAdmData"
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
                <div class="card-footer text-muted" v-if="editMode">
                  <div class="row text-center">
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

              <button
                v-if="true"
                class="btn btn-danger text-left btn-block mt-3"
                @click="removeSettings()"
              >
                <i class="fa-fw fas fa-trash"></i>
                Remover item
              </button>
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

  </div>
</template>

<script>
import MoItemCrud from "../molecules/MoItemCrud.vue";
import VueJsonPretty from "vue-json-pretty";
export default {
  name: "OrAdmSettings",
  components: {
    MoItemCrud,
    VueJsonPretty
  },
  mounted() {
    this.settingsObject = Object.assign({}, this.loadSettings());
    const groups = this.settingsObject.groups;



  },
  methods: {
    selectItem(item) {
      this.selectedItem = item;
      console.log(`Capturado ${this.item}`);
    },
    addItem(payload) {
      const vm = this;
      const category = payload[1];
      const item = payload[0];

      if (category === "group") {
        if (vm.settingsObject.groups) {
          Object.keys(item).forEach(function(key) {
            Vue.set(vm.settingsObject.groups, key, item[key]);
          });
        } else {
          Vue.set(vm.settingsObject, "groups", item);
        }
      } else if (category === "propValue") {
        const key = this.selectedAdmPath.replace("settingsJSON.", "");
        const newItem = Object.assign({}, item);

        _.set(this.settingsObject, key, newItem);
      } else if (category === "keyValue") {
        const key = this.selectedAdmPath.replace("settingsJSON.", "");
        const chave = payload[0][0];
        const valor = payload[0][1];
        Vue.set(vm.selectedAdmData, chave , valor);

      //  _.set(this.settingsObject, key, newItem);
      } else if (category === "propObject") {
        const key = this.selectedAdmPath.replace("settingsJSON.", "");
        const newItem = Object.assign({}, item);
        _.set(this.settingsObject, key, newItem);
      }
    },
    saveSettings() {
      const localSettings = this.loadSettings() ? this.loadSettings() : {};
      const newSettings = Object.assign(localSettings, this.settingsObject);
      const saveSettings = JSON.stringify(newSettings);

      localStorage.setItem("settings", saveSettings);
    },

    saveAdmSettings(event) {
      const key = this.selectedAdmPath.replace("settingsJSON.", "");

      _.set(this.settingsObject, key, this.newSelectedAdmData);
    },
    dontSaveAdmSettings() {
      this.editMode = false;
      this.newSelectedAdmData = null;
    },
    removeSettings() {
      const key = this.selectedAdmPath.replace("settingsJSON.", "");

      this.$bvModal
        .msgBoxConfirm("Tem certeza que deseja prosseguir?")
        .then(value => {
          if (value) {
            _.unset(this.settingsObject, key);
            this.$forceUpdate();
          }
        })
        .catch(err => {
          console.log(err);
        });
    },
    propertyChange() {
      this.editMode = true;
    },
    confirmModal() {
      this.confirmed = false;
      this.$bvModal
        .msgBoxConfirm("Tem certeza que deseja prosseguir?")
        .then(value => {
          this.confirmed = value;
        })
        .catch(err => {
          this.confirmed = false;
        });
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
      confirmed: false,
    };
  }
};
</script>

<style>
</style>