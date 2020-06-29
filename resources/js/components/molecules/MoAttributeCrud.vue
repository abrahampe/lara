<template>
  <div class="card">
    <div class="card">
      <div class="card-header text-white bg-primary"> <span>
              <i :class="selectedParent.icon ? selectedParent.icon : defaultInfo.icon" class="fa-fw"></i> {{selectedParent.description ? selectedParent.description : defaultInfo.description }}
             </span></div>
      <div class="card-body">
        <form class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo</label>
          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
            <option selected disabled>Escolha...</option>
            <option value="1">Grupo</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
<at-icon-selector></at-icon-selector>
          <label class="sr-only" for="inlineFormInputName2">Name</label>
          <input
            type="text"
            class="form-control mb-2 mr-sm-2"
            id="inlineFormInputName2"
            placeholder="Jane Doe"
          />

          <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">@</div>
            </div>
            <input
              type="text"
              class="form-control"
              id="inlineFormInputGroupUsername2"
              placeholder="Username"
            />
          </div>

          <div class="form-check mb-2 mr-sm-2">
            <input class="form-check-input" type="checkbox" id="inlineFormCheck" />
            <label class="form-check-label" for="inlineFormCheck">Remember me</label>
          </div>

          <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
        <button class="btn btn-primary">Adicionar item</button>
      </div>
    </div>
  </div>
</template>

<script>
import AtIconSelector from "../atoms/AtIconSelector.vue";
export default {
  name: "MoAttributeCrud",
    components: {
    AtIconSelector,
  },
  props: {
      selectedParent: {
          type: Object,
      },
      defaultInfo: {
          type: Object,
      },
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
