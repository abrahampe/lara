<template>
  <div>
    <div v-if="started" class="card bg-light mb-3 text-left">
      <div class="card-header">Adicionar</div>
      <div class="card-body">
        <div class="form-group">
          <small>Tipo do item</small>
          <select @change="adjustForm()" v-model="category" class="custom-select">
            <option value="group">Grupo</option>
            <option value="propValue">Item Simples</option>
            <option value="keyValue">Chave-valor</option>
            <option value="propObject">Item Árvore</option>
          </select>
        </div>

        <p>{{selectedItem}}</p>
        <form class="form-inline mt-3" v-if="showIconForm">
          <div class="form-group">
            <div class="custom-control custom-switch">
              <input
                type="checkbox"
                v-model="showIconSelector"
                class="custom-control-input"
                id="customSwitch1"
              />
              <label class="custom-control-label" for="customSwitch1">Adicionar ícone</label>
            </div>
            <at-icon-selector
              class="ml-3"
              v-if="showIconSelector"
              @iconChange="attachIcon($event)"
            />
          </div>
        </form>
        <form class="mt-3">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="Identificador do item"
              v-model="slug"
            />
          </div>
        </form>
        <form v-if="category != 'keyValue'" class="mt-3">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="Descrição Amigável do item"
              v-model="description"
            />
          </div>
        </form>
        <form v-if="showDataType" class="mt-3">
          <div class="form-group">
            <small>Tipo do dado</small>
            <select @change="adjustData()" v-model="dataType" class="custom-select">
              <option value="string">String</option>
              <option value="number">Número</option>
              <option value="boolean">Booleano</option>
            </select>
          </div>
        </form>
        <hr />
        <div class="row mt-3 text-center">
          <div class="col-6">
            <button
              type="button"
              class="btn btn-block btn-outline-secondary mx-auto"
              @click="dontAddItem()"
            >Desistir</button>
          </div>
          <div class="col-6">
            <button
              type="button"
              class="btn btn-block btn-primary mx-auto"
              @click="addItem()"
            >Confirmar</button>
          </div>
        </div>
      </div>
    </div>

    <button
      v-if="!started"
      class="btn btn-primary text-left btn-block mb-3"
      @click="started = true"
    >
      <i class="fa-fw fas fa-plus"></i>
      Adicionar item
    </button>
  </div>
</template>

<script>
import AtIconSelector from "../atoms/AtIconSelector.vue";

export default {
  name: "MoItemCrud",
  components: {
    AtIconSelector
  },
  props: {
    itemFull: {
      type: Object,
      default: undefined
    },
    selectedItem: {
      type: String,
      default: "groups"
    }
  },
  data() {
    return {
      started: false,
      showIconSelector: false,
      showIconForm: false,
      showDataType: false,
      keyValue: undefined,
      dataType: "",
      category: "",
      icon: "fas fa-info",
      slug: "",
      description: "",
      finalObject: {}
    };
  },
  methods: {
    addItem() {
      const vm = this;
      const metadata = {
        icon: this.showIconSelector ? this.icon : null,
        description: this.description
      };

      if (this.category == "group") {
        Vue.set(metadata, "items", {});
        Vue.set(vm.finalObject, vm.slug, metadata);

        const completeObject = Object.assign({}, vm.finalObject);
        this.$emit("newItem", [completeObject, vm.category]);
      }

      if (this.category == "propValue") {
        Vue.set(metadata, "value", "");
        Vue.set(vm.finalObject, vm.slug, metadata);

        const completeObject = Object.assign({}, vm.finalObject);
        this.$emit("newItem", [completeObject, vm.category]);
        //  this.newGroup = Object.assign({}, emptyItem);
      }
      if (this.category == "keyValue") {
        const keyValue = [vm.slug, this.keyValue];

        this.$emit("newItem", [keyValue, vm.category]);
        //  this.newGroup = Object.assign({}, emptyItem);
      }
      if (this.category == "propObject") {
        Vue.set(metadata, "values", {});
        Vue.set(vm.finalObject, vm.slug, metadata);

        const completeObject = Object.assign({}, vm.finalObject);
        this.$emit("newItem", [completeObject, vm.category]);
        //  this.newGroup = Object.assign({}, emptyItem);
      }
    },
    dontAddItem() {
      //this.baseItem = Object.assign({}, emptyItem);
      this.started = false;
    },
    attachIcon(icon) {
      this.icon = icon;
    },

    adjustData() {
      switch (this.dataType) {
        case "string":
          this.keyValue = "";
          break;
        case "number":
          this.keyValue = 0;
          break;
        case "boolean":
          this.keyValue = false;
          break;

        default: this.keyValue = "";
          break;
      }

    },
    adjustForm() {
      this.showIconForm = true;
      const checkDataList = ["propValue", "keyValue"];
      const checkIconList = ["group", "propValue", "propObject"];

      //Controla exibição de ícone
      if (checkIconList.includes(this.category)) {
        this.showIconForm = true;
      } else {
        this.showIconForm = false;
      }

      if (checkDataList.includes(this.category)) {
        this.showDataType = true;
      } else {
        this.showDataType = false;
      }
    }
  }
};
</script>
