<template>
    <div class="main-layout-wrapper">
      <div class="main-layout-card-header-with-button">
        <div class="main-layout-card-content-wrapper">
          <div class="main-layout-card-header-contents">
            <h5 class="m-0">{{ trans('lang.pedidosEP') }}</h5>
          </div>
        </div>
      </div>
  
      <datatable-component class="main-layout-card-content" :options="tableOptions" :exportData="exportToVue"
                           exportFileName="pedidos" @resetStatus="resetExportValue"></datatable-component>
  
      <!-- Modal -->
      <div class="modal fade" id="pedido-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <pedido-detail-modal class="modal-content" v-if="isActive" :id="selectedItemId"
                                :modalOptions="modalOptions"></pedido-detail-modal>
        </div>
      </div>
  
      <!-- Delete Modal -->
      <confirmation-modal id="confirm-delete" :message="'departamento_deleted_permanently'" :firstButtonName="'yes'"
                          :secondButtonName="'no'"
                          @confirmationModalButtonAction="confirmationModalButtonAction"></confirmation-modal>
    </div>
  </template>
  
  <script>
  import axiosGetPost from '../../helper/axiosGetPostCommon';
  
  var sourceURL = '/pedidos';
  
  export default {
    props: ['permission'],
    extends: axiosGetPost,
    data() {
      return {
        tableOptions: {
          tableName: 'departamdentos',
          columns: [
            {title: 'lang.id', key: 'orderID', type: 'text', sortable: true},
            {title: 'lang.invoice_id', key: 'invoice_id', type: 'text', sortable: true},
            {title: 'lang.customer', key: 'first_name', type: 'text', sortable: true},
            {title: 'lang.area', key: 'area', type: 'text', sortable: true},
            
            {title: 'lang.date', key: 'date', type: 'text', sortable: true},
            {title: 'lang.total', key: 'total', type: 'text', sortable: true},
            {title: 'lang.status', key: 'status', type: 'text', sortable: true},
            (this.permission !== 'read_only' ? {
              title: 'lang.action',
              type: 'component',
              key: 'action',
              componentName: 'pedidos-action-component'
            } : {})
  
          ],
          source: '/pedidosPreparacion',
          search: false,
          right_align: 'action',
        },
  
        modalOptions: {
          modalID: '#pedido-detail-modal',
          titleLang: 'Detalle del pedido',
          getDataURL: sourceURL,
          postDataWithIDURL: sourceURL,
          postDataWithoutIDURL: sourceURL + '/store',
        },
        buttonLoader: false,
        isDisabled: false,
        exportToVue: false,
      }
    },
  
    mounted() {
      let instance = this;
      this.$hub.$on('pedidosDetail', function (id) {
        instance.addEditAction(id);
      });
      this.modalCloseAction(this.modalOptions.modalID);
    },
  
    methods: {
      confirmationModalButtonAction() {
        this.deleteDataMethod(sourceURL + '/delete/' + this.deleteID, this.deleteIndex);
      },
      resetPedidoDetailModal(value, save) {
        $("#pedido-detail-modal").on("hidden.bs.modal", function (e) {
          this.isActiveAttributeModal = false;
          $("body").addClass("modal-open");
        });
        this.checkStatus = value;
        if (save) this.bus.$emit("saveStatus");
      },
      resetExportValue(value) {
        this.exportToVue = value;
        this.buttonLoader = false;
        this.isDisabled = false;
  
      }
    }
  }
  
  </script>