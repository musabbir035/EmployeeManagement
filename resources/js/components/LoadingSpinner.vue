<template>
  <div :class="{ 'spinner-backdrop': backdrop }">
    <div class="loader quantum-spinner"></div>
  </div>
</template>

<script>
export default {
  props: ["backdrop"],
};
</script>
