<template>
    <div class="list-group">
       <button
        v-for="(item, index) in itemList"
            type="button"
            class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center"
            :class="index == selectedIndex ? 'active' : ''"
            :key="index"
            @click="itemClick(item, index)"
        >
           <span>
              <i :class="item.icon" class="fa-fw"></i> {{item.description}}
             </span>
            <span class="badge badge-default badge-pill">></span>
        </button>
        
    </div>
</template>

<script>
export default {
    name: 'MoListItem',
    props: {
      itemList: {
        type: Array,

      },
      selected:{
        type: Boolean,
        default: false,
      }
    },
  methods: {
    itemClick(item, index) {
      this.selectedIndex = index;
      this.$emit('itemClick', item, index)
    }
  },
    data() {
        return {
            selectedIndex:  0
        };
    }
};
</script>

<style></style>
