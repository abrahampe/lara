<template>
  <b-button-group class="mx-1">
    <b-button
      v-for="(theme, index) in arrayThemes"
      :key="index"
      :variant="variant"
      :pressed="selectedTheme == theme.key"
      @click="themeHelper.theme = theme.key"
    >{{ theme.key | capitalize}}</b-button>
  </b-button-group>
</template>

<script>
const ThemeHelper = function() {
  const preloadTheme = href => {
    let link = document.createElement("link");
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
    Object.keys(themes).forEach(n => (themes[n].disabled = n !== name));
  };

  let themes = {};

  return {
    add(name, href) {
      return preloadTheme(href).then(s => (themes[name] = s));
    },
    set theme(name) {
      selectTheme(themes, name);
    },
    get theme() {
      return Object.keys(themes).find(n => !themes[n].disabled);
    }
  };
};

export default {
  props: {
    temas: {
      type: Object,
      default: function() {
        return { default: "css/app.css" };
      }
    },
    variant: {
      type: String,
    },
  },
  data() {
    return {
      themes: {
        default: "css/app.css",
        ...this.temas
      },
      themeHelper: new ThemeHelper(),
      selectedTheme: "default",
      loading: true
    };
  },
  watch: {
    themeHelper: {
      handler: function(val, oldVal) {
        this.selectedTheme = val.theme;
      },
      deep: true
    }
  },
  computed: {
    arrayThemes: function() {
      return Object.entries(this.themes).map(([key, value]) => ({
        key,
        value
      }));
    }
  },
  filters: {
    capitalize: function(value) {
      if (!value) return "";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
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
      this.themeHelper.theme = "default";
    });
  }
};
</script>
