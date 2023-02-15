<template>
  <div class="action-button-wrapper">
    <div class='action-button-container'>
      <a href="" class='action-button' data-toggle="modal" data-target="#pedido-detail-modal"
         @click.prevent="pedidosDetail(rowData.orderID)"><i class="la la-info-circle"></i></a>
    </div>
    <i class="la la-ellipsis-v la-1x"></i>
  </div>
</template>


<script>
export default {
  props: ['rowData', 'rowIndex'],
  data() {
    return {}
  },
  mounted() {
    $(".action-button-wrapper")
        .on("mouseover", function () {
          $(this).addClass("active");
        })
        .on("mouseleave", function () {
          $(this).removeClass("active");
        });
  },
  methods: {
    pedidosDetail(id) {
      this.$hub.$emit('pedidosDetail', id);
    }
  }
}
</script>
