<template>
  <div class="main-layout-wrapper">
    <div class="main-layout-card-header-with-button">
      <div class="main-layout-card-content-wrapper">
        <div class="main-layout-card-header-contents">
          <h5 class="m-0">{{ trans('lang.puntos_entrega') }}</h5>
        </div>
        <div v-if="permission !== 'read_only'"
             class="main-layout-card-header-contents text-right d-flex justify-content-end">
          <div class="p-1">
            <button class="btn btn-primary app-color" data-toggle="modal" data-target="#punto-entrega-add-edit-modal"
                    @click.prevent="addEditAction('')">
              {{ trans('lang.add') }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <datatable-component class="main-layout-card-content" :options="tableOptions" :exportData="exportToVue"
                         exportFileName="punto_entrega" @resetStatus="resetExportValue"></datatable-component>

    <!-- Modal -->
    <div class="modal fade" id="punto-entrega-add-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <add-edit-punto-entrega-modal class="modal-content" v-if="isActive" :id="selectedItemId"
                                      :modalOptions="modalOptions"></add-edit-punto-entrega-modal>
      </div>
    </div>

    <!-- Delete Modal -->
    <confirmation-modal id="confirm-delete" :message="'delivery_point_deleted_permanently'" :firstButtonName="'yes'"
                        :secondButtonName="'no'"
                        @confirmationModalButtonAction="confirmationModalButtonAction"></confirmation-modal>
  </div>
</template>

<script>
import axiosGetPost from '../../helper/axiosGetPostCommon';

var sourceURL = '/punto_entrega';

export default {
  props: ['permission'],
  extends: axiosGetPost,
  data() {
    return {
      tableOptions: {
        tableName: 'punto_entregas',
        columns: [
          {title: 'lang.id', key: 'id', type: 'text', sortable: true},
          {title: 'lang.nombre_punto_entrega', key: 'name', type: 'text', sortable: true},
          {title: 'lang.nombre_municipio', key: 'nombreMunicipio', type: 'text', sortable: true},
          (this.permission !== 'read_only' ? {
            title: 'lang.action',
            type: 'component',
            key: 'action',
            componentName: 'punto-entrega-action-component'
          } : {})

        ],
        source: '/puntos_entrega',
        search: false,
        right_align: 'action',
      },

      modalOptions: {
        modalID: '#punto-entrega-add-edit-modal',
        addLang: 'lang.add_punto_entrega',
        editLang: 'lang.edit_punto_entrega',
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
    this.$hub.$on('puntoEntregaAddEdit', function (id, name) {
      instance.addEditAction(id, name);
    });
    this.modalCloseAction(this.modalOptions.modalID);
  },

  methods: {
    confirmationModalButtonAction() {
      this.deleteDataMethod(sourceURL + '/delete/' + this.deleteID, this.deleteIndex);
    },
    resetPuntoEntregaModal(value, save) {
      $("#punto-entrega-add-edit-modal").on("hidden.bs.modal", function (e) {
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