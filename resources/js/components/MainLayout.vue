<template>
  <div>
    <navigation />
    <div class="main" :class="mainMargin">
      <router-view />
    </div>
  </div>
</template>

<script>
import Navigation from "./Navigation.vue";

export default {
  components: { Navigation },
  data() {
    return {
      mainMargin: null,
    };
  },
};
</script>
