<template>
    <div class="list-group">
       <button
        v-for="(item, index) in itemList"
            type="button"
            class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center"
            :class="item.active ? 'active' : ''"
            :key="index"
            @click="itemClick(index)"
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
  methods: {
    itemClick(index) {
      console.log(index);
      this.$emit('itemClick', index)
    }
  },
    data() {
        return {
            itemList: [
              { 
                icon: "fab fa-angellist",
                description: 'Primeiro item',
                active: true,

               },
              { 
                icon: "fas fa-camera",
                description: 'Secondo item',
                active: false,

               },
              { 
                icon: "fas fa-chart-bar",
                description: 'terceiro item',
                active: false,

               },
              { 
                icon: "fas fa-chart-line",
                description: 'Quarto item',
                active: false,

               },
               ]
        };
    }
};
</script>

<style></style>
