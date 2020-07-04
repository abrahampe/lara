<template>
  <div>
    <div v-if="started" class="card text-left">
      <div class="card-body">
        <h5 class="card-title text-muted">Adicionar Grupo</h5>

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
        <hr>
            <div class="row mt-3 text-center">
              <div class="col-6">
                <button 
                type="button" 
                class="btn btn-block btn-outline-secondary mx-auto"
                @click="started = false"
                >Desistir</button>
              </div>
              <div class="col-6">
                <button 
                type="button" 
                class="btn btn-block btn-primary mx-auto"
                @click="addGroup()"
                >Confirmar</button>
              </div>
            </div>


      </div>
    </div>

    <button v-if="!started" class="btn btn-outline-primary text-left btn-block my-3" @click="started = true">
      <i class="fa-fw fas fa-plus"></i>
      Adicionar Grupo
    </button>
  </div>
</template>

<script>
import AtIconSelector from "../atoms/AtIconSelector.vue";
export default {
  name: "MoGroupCrud",
  components: {
    AtIconSelector
  },
  data() {
    return {
      started: false,
      newGroup: {
        icon: "fas fa-info",
        description: ""
      }
    };
  },
  methods: {
    addGroup() {
      this.$emit("newGroup", this.newGroup);
    },
    attachIcon(icon){
      this.newGroup.icon = icon;
    }
  }
};
</script>
