<template>
  <div class="main-layout-wrapper">
    <div class="main-layout-card-header-with-button">
      <div class="main-layout-card-content-wrapper">
        <div class="main-layout-card-header-contents">
          <h5 class="m-0">Municipios</h5>
        </div>
        <div v-if="permission !== 'read_only'"
             class="main-layout-card-header-contents text-right d-flex justify-content-end">
          <div class="p-1">
            <button class="btn btn-primary app-color" data-toggle="modal" data-target="#municipio-add-edit-modal"
                    @click.prevent="addEditAction('')">
              {{ trans('lang.add') }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <datatable-component class="main-layout-card-content" :options="tableOptions" :exportData="exportToVue"
                         exportFileName="municipios" @resetStatus="resetExportValue"></datatable-component>

    <!-- Modal -->
    <div class="modal fade" id="municipio-add-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <add-edit-municipio-modal class="modal-content" v-if="isActive" :id="selectedItemId"
                                       :modalOptions="modalOptions"></add-edit-municipio-modal>
      </div>
    </div>

    <!-- Delete Modal -->
    <confirmation-modal id="confirm-delete" :message="'brand_deleted_permanently'" :firstButtonName="'yes'"
                        :secondButtonName="'no'"
                        @confirmationModalButtonAction="confirmationModalButtonAction"></confirmation-modal>
  </div>
</template>

<script>
import axiosGetPost from '../../helper/axiosGetPostCommon';

var sourceURL = '/municipio';

export default {
  props: ['permission'],
  extends: axiosGetPost,
  data() {
    return {
      tableOptions: {
        tableName: 'municipios',
        columns: [
          {title: 'lang.id', key: 'id', type: 'text', sortable: true},
          {title: 'lang.name', key: 'name', type: 'text', sortable: true},
          {title: 'lang.id', key: 'nombreDepartamento', type: 'text', sortable: true},
          (this.permission !== 'read_only' ? {
            title: 'lang.action',
            type: 'component',
            key: 'action',
            componentName: 'municipio-action-component'
          } : {})
        ],
        source: '/municipios',
        search: false,
        right_align: 'action',
      },

      modalOptions: {
        modalID: '#municipio-add-edit-modal',
        addLang: 'lang.add_brand',
        editLang: 'lang.edit_brand',
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
    this.$hub.$on('municipioAddEdit', function (id, name) {
      instance.addEditAction(id, name);
    });

    this.modalCloseAction(this.modalOptions.modalID);
  },

  methods: {
    confirmationModalButtonAction() {
      this.deleteDataMethod(sourceURL + '/delete/' + this.deleteID, this.deleteIndex);
    },
    resetMunicipioModal(value, save) {
      $("#municipio-add-edit-modal").on("hidden.bs.modal", function (e) {
        this.isActiveAttributeModal = false;
        $("body").addClass("modal-open");
      });
      this.checkStatus = value;
      if (save) this.bus.$emit("saveStatus");
    }
  }
}

</script>