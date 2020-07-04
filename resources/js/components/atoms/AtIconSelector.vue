<template>
  <vfa-picker @input="updateIcon()" :only="['regular', 'solid']" v-model="v">
    <template v-slot:activator="{ on }">
      <div class="dropdown">
        <button
          :class="btnStyle"
          class="pl-3 pr-2 btn dropdown-toggle"
          @click="on"
          type="button"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <span class="pr-2 fas" :class="vc"></span>
        </button>
      </div>

    </template>
  </vfa-picker>
</template>

<script>
export default {
  name: "AtIconSelector",
  props: {
    btnStyle: {
      type: String,
      default: "btn-outline-primary"
    }
  },
  methods: {
    updateIcon() {
      this.$emit("iconChange", this.vc);
    }
  },
  data() {
    return {
      v: undefined
    };
  },
  computed: {
    vc() {
      const icon = this.v ? this.v : "info";
      return `fas fa-${icon}`;
    }
  }
};
</script>