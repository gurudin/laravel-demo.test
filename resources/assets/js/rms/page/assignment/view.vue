<template>
<div class="view">
  <div class="col-12">
    <div class="row justify-content-between">
      <div class="col-8 h3">{{ $t("assignment.assignment") }}</div>

      <div class="col-4 text-right">
        <router-link :to="{path: '/assignment'}" class="btn col-4 btn-light">
          <i class="fa fa-arrow-left"></i> {{$t('common.back')}}
        </router-link>
      </div>
    </div>
  </div>

</div>

</template>

<script>
export default {
  created() {
    console.log(this.$route);
    
  }
};
</script>
