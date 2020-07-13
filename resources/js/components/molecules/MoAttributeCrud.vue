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
        variant="primary"
        class="mb-3"
        :temas="selectedParent.items.avaliable.values"
      ></mo-theme-selector>

      <button class="mt-3 btn btn-primary">Adicionar item</button>
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
    defaultInfo: {
      type: Object
    }
  },
  methods: {
    itemClick(index) {
      console.log(index);
      this.$emit("itemClick", index);
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
