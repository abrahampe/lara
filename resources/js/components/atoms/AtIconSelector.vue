<template>
  <vfa-picker :only="['regular', 'solid']"  v-model="v">
    <template v-slot:activator="{ on }">
      <i class="fas" :class="vc" ></i>
      <input v-model="v" @click="on" placeholder="Escolha" type="text" />
    </template>
  </vfa-picker>
</template>

<script>
export default {
    name: "AtIconSelector",
    data() {
      return {
        v: undefined
      }
    },
    computed: {
      vc() {
        return `fa-${this.v}`; 
      }
    },
}
</script>