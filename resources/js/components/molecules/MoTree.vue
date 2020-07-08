<template>
  <ul id="demo">
    <at-tree-item class="item" :item="treeData" @make-folder="makeFolder" @add-item="addItem"></at-tree-item>
  </ul>
</template>

<script>
import AtTreeItem from "../atoms/AtTreeItem.vue";
var treeData = {
  name: "MoTree",
  children: [
    { name: "hello" },
    { name: "wat" },
    {
      name: "child folder",
      children: [
        {
          name: "child folder",
          children: [{ name: "hello" }, { name: "wat" }]
        },
        { name: "hello" },
        { name: "wat" },
        {
          name: "child folder",
          children: [{ name: "hello" }, { name: "wat" }]
        }
      ]
    }
  ]
};
export default {
  name: "MoTree",
  components: {
    AtTreeItem
  },
  data() {
    return {
      treeData: treeData
    };
  },
  methods: {
    makeFolder(item) {

      Vue.set(item, "children", []);
      this.addItem(item);
    },
    addItem(item) {
      item.children.push({
        name: "new stuff"
      });
    }
  }
};
</script>

<style scoped>
.item {
  cursor: pointer;
}
.bold {
  font-weight: bold !important;
}
ul {
  font-family: Menlo, Consolas, monospace;
  color: #444;
  padding-left: 1em;
  line-height: 1.5em;
  list-style-type: dot;
}
</style>


