<template>
<b-button-group class="mx-1">
      <b-button @click="themeHelper.theme='materia'">Edit</b-button>
      <b-button @click="themeHelper.theme='flatly'">Undo</b-button>
      <b-button @click="themeHelper.theme='solar'">Redo</b-button>
    </b-button-group>
</template>

<script>
const ThemeHelper = function() {
 
  const preloadTheme = (href) => {
    let link = document.createElement('link');
    link.rel = "stylesheet";
    link.href = href;
    document.head.appendChild(link);
    
    return new Promise((resolve, reject) => {
      link.onload = e => {
        const sheet = e.target.sheet;
        sheet.disabled = true;
        resolve(sheet);
      };
      link.onerror = reject;
    });
  };
  
  const selectTheme = (themes, name) => {
    if (name && !themes[name]) {
      throw new Error(`"${name}" has not been defined as a theme.`); 
    }
    Object.keys(themes).forEach(n => themes[n].disabled = (n !== name));
  }
  
  let themes = {};

  return {
    add(name, href) { return preloadTheme(href).then(s => themes[name] = s) },
    set theme(name) { selectTheme(themes, name) },
    get theme() { return Object.keys(themes).find(n => !themes[n].disabled) }
  };
};
const themes = {
  flatly: "https://bootswatch.com/4/flatly/bootstrap.min.css",
  materia: "https://bootswatch.com/4/materia/bootstrap.min.css",
  solar: "https://bootswatch.com/4/solar/bootstrap.min.css"
};

export default {
data() {
    return {
      themes: {
        flatly: "https://bootswatch.com/4/flatly/bootstrap.min.css",
        materia: "https://bootswatch.com/4/materia/bootstrap.min.css",
        solar: "https://bootswatch.com/4/solar/bootstrap.min.css"
      },
      themeHelper: new ThemeHelper(),
      loading: true,
    }
  },
  created() {
    // add/load themes
    let added = Object.keys(this.themes).map(name => {
      return this.themeHelper.add(name, this.themes[name]);
    });

    Promise.all(added).then(sheets => {
      console.log(`${sheets.length} themes loaded`);
      this.loading = false;
      this.themeHelper.theme = "flatly";
    });
  }

}
</script>
