<template>
    <div class="list-group">




        <button
        v-for="(item, index) in itemList"
            type="button"
            class="list-group-item list-group-item-action"
            :class="item.active ? 'active' : ''"
            :key="index"
        >
            <i :class="item.icon" class="fa-fw"></i>Teste {{item.description}}
        </button>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            itemList: [
              { 
                icon: "fab fa-angellist",
                description: 'Primeiro item',
                active: true,

               },
              { 
                icon: "fab fa-angellist",
                description: 'Secondo item',
                active: false,

               },
              { 
                icon: "fab fa-angellist",
                description: 'terceiro item',
                active: false,

               },
              { 
                icon: "fab fa-angellist",
                description: 'Quarto item',
                active: false,

               },
               ]
        };
    }
};
</script>

<style></style>
