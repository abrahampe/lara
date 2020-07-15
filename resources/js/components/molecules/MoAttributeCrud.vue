<template>
  <div class="card">
    <div class="card-header text-white bg-primary">
      <span>
        <i :class="selectedParent.icon ? selectedParent.icon : defaultInfo.icon" class="fa-fw"></i>
        {{selectedParent.description ? selectedParent.description : defaultInfo.description }}
      </span>
    </div>
    <div class="card-body">
      <mo-theme-selector
        v-if="selectedParent.items"
        variant="outline-primary"
        class="mb-3"
        :temas="selectedParent.items.avaliable.values"
        @selectTheme="updateSelectedTheme($event)"
      ></mo-theme-selector>

    </div>
  </div>
</template>

<script>
import AtIconSelector from "../atoms/AtIconSelector.vue";
import MoThemeSelector from "../molecules/MoThemeSelector";
export default {
  name: "MoAttributeCrud",
  components: {
    AtIconSelector,
    MoThemeSelector
  },
  props: {
    selectedParent: {
      type: Object
    },
    fullSettings: {
      type: Object
    },
    defaultInfo: {
      type: Object
    }
  },
  methods: {
    itemClick(index) {
      console.log(index);
      this.$emit("itemClick", index);
    },
    updateSelectedTheme(event){
     const vm = this;

      Vue.set(vm.fullSettings.groups.themes.items.selected, 'value' , event.value );

    }
  },
  data() {
    return {
      selectParent: {
        icon: "fab fa-angellist",
        description: "Primeiro item",
        active: true
      }
    };
  }
};
</script>

<style></style>
