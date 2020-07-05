<template>
    <div class="list-group">
      <div v-if="Object.keys(itemList).length === 0" class="list-group-item disabled list-group-item-action text-muted">Sem grupos cadastrados</div>
       <button
        v-for="(item, index) in itemList"
            type="button"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
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
        type: Object,
        default: ()=>{
          return {};

        }

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
            selectedIndex:  0,
        };
    }
};
</script>

<style></style>
