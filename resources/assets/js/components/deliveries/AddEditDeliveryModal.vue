<template>
  <div>
    <div class="modal-layout-header">
      <div class="row">
        <div class="col-10">
          <h5 class="bluish-text" v-if="id">{{ trans(modalOptions.editLang) }}</h5>
          <h5 class="bluish-text" v-else>{{ trans(modalOptions.addLang) }}</h5>
        </div>
        <div class="col-2 text-right">
          <button type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                  @click.prevent="closeModal()">
            <i class="la la-close icon-modal-cross"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="modal-layout-content">
      <pre-loader v-if="!hidePreLoader" class="small-loader-container"></pre-loader>
      <form class="form-row margin-top" v-else>
        <div class="form-group col-md-12">
          {{ alertMessage }}
          <label for="nombre_delivery">{{ trans('lang.nombre_delivery') }}</label>
          <input v-validate="'required'" name="nombre_delivery" class="form-control" id="nombre_delivery"
                 type="text" v-model="nombre_delivery" :class="{ 'is-invalid': submitted && errors.has('nombre_delivery') }">
          <div class="heightError" v-if="submitted && errors.has('nombre_delivery')">
            <small class="text-danger" v-if="errors.has('nombre_delivery')">{{
                errors.first('nombre_delivery')
              }}</small>
          </div>
        </div>

        <div class="form-group col-md-12">
          {{ alertMessage }}
          <label for="delivery_phone">{{ trans('lang.delivery_phone') }}</label>
          <input v-validate="'required'" name="delivery_phone" class="form-control" id="delivery_phone"
                 type="number" v-model="delivery_phone" :class="{ 'is-invalid': submitted && errors.has('delivery_phone') }">
          <div class="heightError" v-if="submitted && errors.has('delivery_phone')">
            <small class="text-danger" v-if="errors.has('delivery_phone')">{{
                errors.first('delivery_phone')
              }}</small>
          </div>
        </div>

        <div class="form-group col-md-12">
          {{ alertMessage }}
          <label for="delivery_mail">{{ trans('lang.delivery_mail') }}</label>
          <input name="delivery_mail" class="form-control" id="delivery_mail" type="text"
                 v-model="delivery_mail" :class="{ 'is-invalid': submitted && errors.has('delivery_mail') }">
          <div class="heightError" v-if="submitted && errors.has('delivery_mail')">
            <small class="text-danger" v-if="errors.has('delivery_mail')">{{
                errors.first('delivery_mail')
              }}</small>
          </div>
        </div>

        <div class="form-group col-md-12">
          {{ alertMessage }}
          <label for="delivery_type">{{ trans('lang.delivery_type') }}</label>
          <select v-validate="'required'" name="delivery_type" class="form-control" id="delivery_type"
                  v-model="delivery_type" :class="{ 'is-invalid': submitted && errors.has('delivery_type') }">
            <option value="" disabled>{{ trans('lang.choose_one') }}</option>
            <option value="Externo">{{ trans('lang.type_external') }}</option>
            <option value="Interno">{{ trans('lang.type_internal') }}</option>
          </select>
          <div class="heightError" v-if="submitted && errors.has('delivery_type')">
            <small class="text-danger" v-if="errors.has('delivery_type')">{{
                errors.first('delivery_type')
              }}</small>
          </div>
        </div>

        <div class="col-12">
          <button class="btn btn-primary app-color mobile-btn" type="submit" @click.prevent="save()">{{
              trans('lang.save')
            }}
          </button>
          <button class="btn btn-secondary cancel-btn mobile-btn" data-dismiss="modal"
                  @click.prevent="close()">{{ trans('lang.cancel') }}
          </button>
        </div>
      </form>
    </div>

  </div>
</template>

<script>

import axiosGetPost from '../../helper/axiosGetPostCommon';

export default {

  props: ['id', 'modalOptions'],
  extends: axiosGetPost,
  data() {
    return {
      nombre_delivery: '',
      delivery_phone: 0,
      delivery_mail: '',
      delivery_type: '',
      alertMessage: '',
      checkStatus: true,
      saveStatus: false,
      submitted: false,
    }
  },
  created() {
    if (this.id) {
      this.getCommonData(this.modalOptions.getDataURL + '/' + this.id);
    }
  },
  mounted() {
    let instance = this;
    $('#attributes-add-edit-modal').on('hidden.bs.modal', function (e) {
      instance.close();
    });
  },

  methods: {
    close() {
      this.nombre_delivery = '';
      this.delivery_phone = 0;
      this.delivery_mail = '';
      this.delivery_type = '';
      this.$validator.reset();
      this.checkStatus = false;
      this.saveStatus = false;
      this.$emit('resetDeliveryModal', this.checkStatus, this.saveStatus);
    },
    closeModal() {
      $(this.modalOptions.modalID).modal('toggle')
    },
    save() {
      this.submitted = true;
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.inputFields = {
            nombre_delivery: this.nombre_delivery,
            delivery_phone: this.delivery_phone,
            delivery_mail: this.delivery_mail,
            delivery_type: this.delivery_type,
          };
          if (this.id) {
            this.postDataMethod(this.modalOptions.postDataWithIDURL + '/' + this.id, this.inputFields);
          } else {
            this.postDataMethod(this.modalOptions.postDataWithoutIDURL, this.inputFields);
          }
        }
      });
    },
    getCommonData(route) {
      let instance = this;
      this.setPreLoader(false);
      this.axiosGet(route,
          function (response) {
            instance.nombre_delivery = response.data.nombre;
            instance.delivery_phone = response.data.telefono;
            instance.delivery_mail = response.data.correo;
            instance.delivery_type = response.data.tipo;
            instance.setPreLoader(true);
          },
          function (response) {
            instance.setPreLoader(true);
          },
      );
    },
    postDataThenFunctionality(response = null) {
      $(this.modalOptions.modalID).modal('toggle');
      let instance = this;
      instance.saveStatus = true;
      this.nombre_delivery = '';
      this.delivery_phone = 0;
      this.delivery_mail = '';
      this.delivery_type = '';
      this.$validator.reset();
      this.checkStatus = false;
      this.$emit('resetDeliveryModal', this.checkStatus, this.saveStatus);
      if (!this.modalOptions.turnOffLoader) {
        this.$hub.$emit('reloadDataTable');
      } else {
        this.$hub.$emit('reloadAttributeData');
      }
    },
    postDataCatchFunctionality(error) {
    },
  },
}
</script>
