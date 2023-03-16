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
          <label for="nombreRuta">{{ trans('lang.nombre_route') }}</label>
          <input v-validate="'required'" name="nombreRuta" class="form-control" id="nombreRuta"
                 type="text"
                 v-model="nombreRuta" :class="{ 'is-invalid': submitted && errors.has('nombreRuta') }">
          <div class="heightError" v-if="submitted && errors.has('nombreRuta')">
            <small class="text-danger" v-if="errors.has('nombreRuta')">{{
                errors.first('nombreRuta')
              }}</small>
          </div>
        </div>
        <div class="form-group col-md-12">
          <label for="shipping_area">
            {{ trans('lang.shipping_area') }}
          </label>
          <select v-validate="'required'"
                  v-model="shippingAreaId"
                  data-vv-as="shipping area"
                  id="shippingAreaId"
                  name="shipping_area"
                  class="form-control" 
                  :class="{ 'is-invalid': submitted && errors.has('shipping_area') }">
            <option value="" disabled selected>{{ trans('lang.choose_one') }}</option>
            <option v-for="(ship) in shippingAreaData" :value="ship.id">{{ ship.area }}</option>
          </select>
          <div class="heightError">
            <small class="text-danger" v-show="errors.has('shipping_area')">
              {{ errors.first('shipping_area') }}
            </small>
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
      nombreRuta: '',
      shippingAreaId: '',
      alertMessage: '',
      checkStatus: true,
      saveStatus: false,
      submitted: false,
      shippingAreaData: [],
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
    this.axiosGet(
        "/get-areal-list",
        response => {
            this.shippingAreaData = response.data.shippingData;
        },
    );
  },

  methods: {
    close() {
      this.nombreRuta = '';
      this.shippingAreaId = '';
      this.$validator.reset();
      this.checkStatus = false;
      this.saveStatus = false;
      this.$emit('resetRouteModal', this.checkStatus, this.saveStatus);
    },
    closeModal() {
      $(this.modalOptions.modalID).modal('toggle')
    },
    save() {
      this.submitted = true;
      this.$validator.validateAll().then((result) => {
        if (result) {
          this.inputFields = {
            nombreRuta: this.nombreRuta,
            shippingAreaId: this.shippingAreaId,
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
            instance.nombreRuta = response.data.name;
            instance.shippingAreaId = response.data.shipping_area_id;
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
      this.nombreRuta = '';
      this.shippingAreaId = '';
      this.$validator.reset();
      this.checkStatus = false;
      this.$emit('resetRouteModal', this.checkStatus, this.saveStatus);
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