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
            <option value="propObject">Item Árvore</option>
          </select>
        </div>

        <div v-if="hasParentItem" class="form-group">
          <small>Item pai</small>
          <select class="custom-select">
            <option value="groups" selected="selected">Configuração</option>
            <option
              v-for="item in itemFull.groups"
              :key="item.slug"
              :value="item.slug"
            >{{ item.description }}</option>
          </select>
        </div>

        <form class="form-inline mt-3">
          <div v-if="allowIconSelector" class="form-group">
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
        <form class="mt-3">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="Descrição Amigável do item"
              v-model="description"
            />
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
      Adicionar Objeto NV
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
    }
  },
  data() {
    return {
      started: false,
      showIconSelector: false,
      allowIconSelector: false,
      hasParentItem: false,

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
        Vue.set(vm.finalObject, vm.slug, metadata);

        const completeObject = Object.assign({}, vm.finalObject);
        this.$emit("newItem", completeObject);
        //this.newGroup = Object.assign({}, emptyItem);
      }

      if (this.category == "propValue") {
        const parentAttribute = this.category;
        const childAttribute = Object.assign(groupProperty, groups);
        Vue.set(vm.finalObject, parentAttribute, childAttribute);

        const completeObject = Object.assign({}, vm.finalObject);
        this.$emit("newItem", completeObject);
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
    adjustForm() {
      const vm = this;
      Object.keys(vm.itemFull).forEach(function(key) {
        console.log(key, vm.itemFull[key]);
      });

      if (this.category == "group") {
        this.showIconSelector = false;
        this.allowIconSelector = true;
        this.hasParentItem = false;
      } else if (this.category == "propValue") {
        this.showIconSelector = false;
        this.allowIconSelector = false;
        this.hasParentItem = true;
      } else if (this.category == "propObject") {
        this.showIconSelector = false;
        this.allowIconSelector = true;
        this.hasParentItem = true;
      }
    }
  }
};
</script>
