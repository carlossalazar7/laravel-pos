<template>
  <div class="action-button-wrapper">
    <div class='action-button-container'>
      <a href="" class='action-button' @click.prevent="generarPDF(rowData.id,rowIndex)"><i class="las la-file-alt"></i></a>
      <a v-if="rowData.status=='open'" href="" class='action-button' data-toggle="modal" data-target="#close-guide"
         @click.prevent="closeGuide(rowData.id,rowIndex)"><i class="la la-check-circle"></i></a>
      <a href="" class='action-button' data-toggle="modal" data-target="#confirm-delete"
         @click.prevent="selectedDeletableId(rowData.id,rowIndex)"><i class="la la-trash-o la-2x"></i></a>
      <a href="" class='action-button' data-toggle="modal" data-target="#guide-add-edit-modal"
         @click.prevent="guideAddEdit(rowData.id)"><i class="la la-edit la-2x"></i></a>
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
    guideAddEdit(id) {
      this.$hub.$emit('guideAddEdit', id);
    },
    selectedDeletableId(id, index) {
      this.$hub.$emit('selectedDeletableId', id, index);
    },
    generarPDF(id) {
      this.$hub.$emit('generarPDF', id);
    },
    closeGuide(id) {
      this.$hub.$emit('closeGuide', id);
    },
  }
}
</script>
