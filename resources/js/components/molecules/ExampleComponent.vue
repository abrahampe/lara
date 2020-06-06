<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>
          <div class="card-body">
              <at-loader :loading="globalLoading"></at-loader>
              <strong>{{hello.hello}}</strong>
              </div>
              <hr>
              <notification-test></notification-test>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import AtLoader from "../atoms/AtLoader.vue";
import NotificationTest from "../molecules/NotificationTest.vue";
export default {
  //php phpDocumentor.phar -d . -t docs/api
  name: "ExampleComponent",
  components: {
    AtLoader,
    NotificationTest,
  },
  mounted() {
   this.getHello();
  },
  data() {
    return {
      ip: ""
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
