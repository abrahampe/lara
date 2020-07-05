<template>
  <div>
    <div v-if="started" class="card bg-light mb-3 text-left">
      <div class="card-header">Adicionar</div>
      <div class="card-body">
        <div class="form-group">
          <select class="custom-select">
            <option selected="selected">Novo Grupo</option>
            <option
              v-for="item in itemList"
              :key="item.description"
              value="1"
            >Filho de {{ item.description }}</option>
          </select>
        </div>

        <form class="form-inline mt-3">
          <div class="form-group">
            <at-icon-selector @iconChange="attachIcon($event)" />
            <label for></label>
            <input
              type="text"
              class="form-control ml-2"
              placeholder="Nome do grupo"
              v-model="newGroup.description"
            />
          </div>
        </form>
        <hr />
        <div class="row mt-3 text-center">
          <div class="col-6">
            <button
              type="button"
              class="btn btn-block btn-outline-secondary mx-auto"
              @click="dontAddGroup()"
            >Desistir</button>
          </div>
          <div class="col-6">
            <button
              type="button"
              class="btn btn-block btn-primary mx-auto"
              @click="addGroup()"
            >Confirmar</button>
          </div>
          <div class="col-12">
            <button type="button" class="btn btn-block btn-primary mx-auto" @click="addItem()">Teste</button>
          </div>
        </div>
      </div>
    </div>

    <button
      v-if="!started"
      class="btn btn-outline-primary text-left btn-block my-3"
      @click="started = true"
    >
      <i class="fa-fw fas fa-plus"></i>
      Adicionar Objeto
    </button>
  </div>
</template>

<script>
import AtIconSelector from "../atoms/AtIconSelector.vue";
const emptyGroup = {
  icon: "fas fa-info",
  description: "",
  items: ""
};
export default {
  name: "MoGroupCrud",
  components: {
    AtIconSelector
  },
  props: {
    itemList: {
      type: Array,
      default: undefined
    },
    itemFull: {
      type: Object,
      default: undefined
    }
  },
  data() {
    return {
      started: false,
      groups: {},
      newGroup: {
        icon: "fas fa-info",
        description: "",
        items: ""
      }
    };
  },
  methods: {
    addGroup(group = {}) {
      const vm = this;

      const finalGroup = Object.assign(group, this.newGroup);

      this.$emit("newGroup", finalGroup);
      this.newGroup = Object.assign({}, emptyGroup);
    },
    addItem(groupname) {
      const vm = this;
      const gn = "themes";
      const tsn = {
        icon: "fas fa-info",
        description: "sfasfasdfa",
        items: {}
      };
   //   const fn = Object.assign({}, vm.groups)

      //const sn = Object.assign(gn, emptyGroup);
      
      Vue.set(vm.groups, gn, tsn);
      const sn = Object.assign(vm.groups, emptyGroup);
      Object.keys(tsn).forEach(function(key) {
        Vue.set(vm.groups, key, tsn[key]);
      });
      const fn = Object.assign({}, vm.groups)
      this.$emit("newGroup", fn);
      this.newGroup = Object.assign({}, emptyGroup);
    },
    dontAddGroup() {
      this.newGroup = Object.assign({}, emptyGroup);
      this.started = false;
    },
    attachIcon(icon) {
      this.newGroup.icon = icon;
    }
  }
};
</script>
