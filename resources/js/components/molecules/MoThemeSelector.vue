<template>
    <b-button-group class="mx-1">
        <b-button
            :pressed="selectedTheme == 'materia'"
            @click="themeHelper.theme = 'materia'"
            >Tema 1
        </b-button>
        <b-button 
            :pressed="selectedTheme == 'flatly'"
            @click="themeHelper.theme = 'flatly'"
            >Tema 2
        </b-button>
        <b-button
            :pressed="selectedTheme == 'solar'"
            @click="themeHelper.theme = 'solar'"
            >Tema 3
        </b-button>
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
        }
    },
    data() {
        return {
            themes: {
                default: "css/app.css",
                ... this.temas,
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
