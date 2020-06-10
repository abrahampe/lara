<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>
          <div class="card-body">
              <at-loader :loading="globalLoading"></at-loader>
              <strong>{{hello.hello}}</strong>
              <strong>{{ $t('validation.accepted', {attribute: 'test'}) }}</strong>
              </div>
              <hr>
              <notification-test></notification-test>
              <at-switcher v-model="darkTheme" size="lg" id="chk_color"></at-switcher>
              <mo-theme-selector></mo-theme-selector>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import AtLoader from "../atoms/AtLoader.vue";
import AtSwitcher from "../atoms/AtSwitcher.vue";
import MoThemeSelector from "../molecules/MoThemeSelector.vue";
import NotificationTest from "../molecules/NotificationTest.vue";
export default {
  //php phpDocumentor.phar -d . -t docs/api
  name: "ExampleComponent",
  components: {
    AtLoader,
    AtSwitcher,
    MoThemeSelector,
    NotificationTest,
  },
  mounted() {
   this.getHello();
  },
  data() {
    return {
      ip: "",
      darkTheme: false
    };
  },
  computed: {
    ...mapState(['globalLoading', 'hello']),
  },
    methods: {
    ...mapActions({
      getHello: 'getHello',
    }),
  },
};
</script>
