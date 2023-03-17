<template>
  <div>
    <div class="modal-layout-header">
      <div class="row">
        <div class="col-10">
          <h4 class="m-0" v-if="id">{{ trans('lang.edit_customer') }}</h4>
          <h4 class="m-0" v-else>{{ trans('lang.add_customer') }}</h4>
        </div>
        <div class="col-2 text-right">
          <button type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                  @click.prevent="">
            <i class="la la-close icon-modal-cross"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="modal-layout-content">
      <pre-loader v-if="!hidePreLoader"></pre-loader>
      <div v-else>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio"
                 name="persona_natural"
                 class="custom-control-input"
                 id="persona_natural"
                 checked="checked"
                 @click="tipoClienteRdb(1)"
                 value="P"
                 v-model="tipoCliente"
          />
          <label class="custom-control-label"
                 for="persona_natural">
            {{ trans('lang.persona_natural') }}
          </label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio"
                 name="empresa"
                 class="custom-control-input"
                 id="empresa"
                 @click="tipoClienteRdb(0)"
                 value="E"
                 v-model="tipoCliente"
          />
          <label class="custom-control-label"
                 for="empresa">
            {{ trans('lang.empresa') }}
          </label>
        </div>
        <br>

        <div v-if="tipoClienteP">
          <form @submit.prevent="save('form-1')" class="form-row"
                data-vv-scope="form-1">
            <div class="form-group col-md-6">
              <label for="phoneNumber">{{ trans('lang.phone_number') }}</label>
              <p class="control has-icon has-icon-right">
                <input name="phoneNumber" v-validate="'required'" v-model="phoneNumber"
                       :class="{'input': true, 'is-danger': errors.has('form-1.phoneNumber') }" type="text"
                       class="form-control">
                <span v-show="errors.has('form-1.phoneNumber')" class="text-danger">{{
                    errors.first('form-1.phoneNumber')
                  }}</span>
              </p>
            </div>

            <div class="form-group col-md-6">
              <label for="firstName">{{ trans('lang.first_name') }}</label>
              <p class="control has-icon has-icon-right">
                <input name="firstName" v-validate="'required'" v-model="firstName"
                       :class="{'input': true, 'is-danger': errors.has('form-1.firstName') }" type="text"
                       class="form-control">
                <span v-show="errors.has('form-1.firstName')" class="text-danger">{{
                    errors.first('form-1.firstName')
                  }}</span>
              </p>
            </div>

            <div class="form-group col-md-6">
              <label for="lastName">{{ trans('lang.last_name') }}</label>
              <p class="control has-icon has-icon-right">
                <input name="lastName" v-validate="'required'" v-model="lastName"
                       :class="{'input': true, 'is-danger': errors.has('form-1.lastName') }" type="text"
                       class="form-control">
                <span v-show="errors.has('form-1.lastName')" class="text-danger">{{
                    errors.first('form-1.lastName')
                  }}</span>
              </p>
            </div>

            <div class="form-group col-md-6">
              <label for="email">{{ trans('lang.customer_email') }}</label>
              <p class="control has-icon has-icon-right">
                <input name="email" v-model="email"
                       type="text" class="form-control">
              </p>
            </div>

            <div class="col-12">
              <button class="btn app-color mobile-btn" type="submit">
                {{ trans('lang.save') }}
              </button>
              <button class="btn cancel-btn mobile-btn" data-dismiss="modal" @click.prevent="">
                {{ trans('lang.cancel') }}
              </button>
            </div>
          </form>

        </div>

        <div v-if="tipoClienteE">
          <form @submit.prevent="saveEmpresa('form-2')" class="form-row"
                data-vv-scope="form-2">
            <div class="form-group col-md-6">
              <label for="phoneNumber">{{ trans('lang.phone_number') }}</label>
              <p class="control has-icon has-icon-right">
                <input name="phoneNumber" v-validate="'required'" v-model="phoneNumber"
                       :class="{'input': true, 'is-danger': errors.has('form-2.phoneNumber') }" type="text"
                       class="form-control">
                <span v-show="errors.has('form-2.phoneNumber')" class="text-danger">{{errors.first('form-2.phoneNumber')}}</span>
              </p>
            </div>

            <div class="form-group col-md-6">
              <label for="nombreContacto">{{ trans('lang.nombre_contacto') }}</label>
              <p class="control has-icon has-icon-right">
                <input name="nombreContacto" v-validate="'required'" v-model="nombreContacto"
                       :class="{'input': true, 'is-danger': errors.has('form-2.nombreContacto') }" type="text"
                       class="form-control">
                <span v-show="errors.has('form-2.nombreContacto')" class="text-danger">{{
                    errors.first('form-2.nombreContacto')
                  }}</span>
              </p>
            </div>

            <div class="form-group col-md-6">
              <label for="company">{{ trans('lang.empresa') }}</label>
              <p class="control has-icon has-icon-right">
                <input name="company" v-validate="'required'" v-model="company"
                       :class="{'input': true, 'is-danger': errors.has('form-2.company') }" type="text"
                       class="form-control">
                <span v-show="errors.has('form-2.company')" class="text-danger">{{
                    errors.first('form-2.company')
                  }}</span>
              </p>
            </div>

            <div class="form-group col-md-6">
              <label for="nit">{{ trans('lang.nit') }}</label>
              <p class="control has-icon has-icon-right">
                <input name="nit" v-validate="'required'" v-model="nit"
                       :class="{'input': true, 'is-danger': errors.has('form-2.nit') }" type="text"
                       class="form-control">
                <span v-show="errors.has('form-2.nit')" class="text-danger">{{errors.first('form-2.nit')}}</span>
              </p>
            </div>

            <div class="form-group col-md-6">
              <label for="nrc">{{ trans('lang.nrc') }}</label>
              <p class="control has-icon has-icon-right">
                <input name="nrc" v-validate="'required'" v-model="nrc"
                       :class="{'input': true, 'is-danger': errors.has('form-2.nrc') }" type="text"
                       class="form-control">
                <span v-show="errors.has('form-2.nrc')" class="text-danger">{{errors.first('form-2.nrc')}}</span>
              </p>
            </div>

            <div class="col-12">
              <button class="btn app-color mobile-btn" type="submit">
                {{ trans('lang.save') }}
              </button>
              <button class="btn cancel-btn mobile-btn" data-dismiss="modal" @click.prevent="">
                {{ trans('lang.cancel') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axiosGetPost from '../../../helper/axiosGetPostCommon';
import {VueTelInput} from 'vue-tel-input';

export default {
  props: ['id', 'modalID', 'order_type', 'customerGroups', 'status'],
  extends: axiosGetPost,
  components: {VueTelInput},

  data() {
    return {
      firstName: '',
      lastName: '',
      email: '',
      phoneNumber: '',
      address: '',
      company: '',
      customerGroup: '',
      groups: [],
      customer: [],
      submitted: false,
      tinNumber: '',

      tipoCliente: 'P',
      tipoClienteP: true,
      tipoClienteE: '',
      nombreContacto: '',
      nrc: '',
      nit: '',
    }
  },
  created() {
    this.getGroupsData();
    if (this.id) {
      this.getCustomerData('/customer-data/' + this.id);
    }
  },
  mounted() {
    if (localStorage.getItem("customer_phone")) {
      this.phoneNumber = localStorage.getItem("customer_phone");
    }
  },
  methods: {
    validateForm(scope) {
      this.$validator.validateAll(scope).then((result) => {
        if (result) {
          // eslint-disable-next-line
          alert('Form Submitted!');
        }
      });
    },
    save(scope) {
      this.submitted = true;
      this.$validator.validateAll(scope).then((result) => {
        if (result) {
          this.inputFields = {
            first_name: this.firstName,
            last_name: this.lastName,
            email: this.email,
            phone_number: this.phoneNumber,
            customer_group: this.customerGroup,
            tipo_cliente: this.tipoCliente,
          };
          if (navigator.onLine) {
            if (this.id) {
              this.postDataMethod('/customer/' + this.id, this.inputFields);
            } else {
              this.postDataMethod('/customer/store', this.inputFields);
            }
          } else {
            $(this.modalID).modal('hide');
            if (this.order_type != 'sales') {
              this.$hub.$emit('customerAddedFromSales');
              this.$hub.$emit('reloadDataTable');
            }
            this.$emit('newCustomer', this.inputFields);
          }

          let data = {
            first_name: this.firstName,
            last_name: this.lastName,
            email: this.email,
            phone_number: this.phoneNumber,
            customer_group: this.customerGroup,
            tipo_cliente: this.tipoCliente,
          };
          this.$hub.$emit('customerInformation', data);
          localStorage.removeItem("customer_phone");
        }
      });

    },
    saveEmpresa(scope) {
      this.submitted = true;
      this.$validator.validateAll(scope).then((result) => {
        if (this.errors.any()) {
          console.log(this.errors);
        }
        if (result) {
          this.inputFields = {
            phone_number: this.phoneNumber,
            nombre_contacto: this.nombreContacto,
            company: this.company,
            nrc: this.nrc,
            nit: this.nit,
            tipo_cliente: this.tipoCliente,
            customer_group: this.customerGroup,
          };
          if (navigator.onLine) {
            if (this.id) {
              this.postDataMethod('/customer/' + this.id, this.inputFields);
            } else {
              this.postDataMethod('/customer/store', this.inputFields);
            }
          } else {
            $(this.modalID).modal('hide');
            if (this.order_type != 'sales') {
              this.$hub.$emit('customerAddedFromSales');
              this.$hub.$emit('reloadDataTable');
            }
            this.$emit('newCustomer', this.inputFields);
          }
          let data = {
            phone_number: this.phoneNumber,
            nombre_contacto: this.nombreContacto,
            company: this.company,
            nrc: this.nrc,
            nit: this.nit,
            tipo_cliente: this.tipoCliente,
            customer_group: this.customerGroup,
          };
          this.$hub.$emit('customerInformation', data);
          localStorage.removeItem("customer_phone");
        }
      });
    },
    postDataThenFunctionality(response) {
      $(this.modalID).modal('hide');
      if (this.order_type != 'sales') {
        this.$hub.$emit('customerAddedFromSales');
        this.$hub.$emit('reloadDataTable');
      }
      this.$emit('newCustomer', response.data.data);
    },
    postDataCatchFunctionality(error) {
      let instance = this;
    },
    getGroupsData() {
      let instance = this;
      if (instance.status) {
        instance.groups = JSON.parse(instance.customerGroups);
        instance.groups.forEach(function (group) {
          if (group.is_default == 1) {
            instance.customerGroup = group.id;
          }
        });
      } else {
        instance.setPreLoader(false);
        instance.axiosGet('/groups/',
            function (response) {
              instance.groups = response.data;
              if (instance.id) {

              } else {
                instance.setPreLoader(true);
                instance.groups.forEach(function (group) {
                  if (group.is_default == 1) {
                    instance.customerGroup = group.id;
                  }
                });
              }
              instance.setPreLoader(true);
            },
            function (response) {
              instance.setPreLoader(true);
            },
        );
      }
    },
    getCustomerData(route) {

      let instance = this;
      instance.setPreLoader(false);
      instance.axiosGet(route,
          function (response) {
            instance.firstName = response.data.customer.first_name;
            instance.lastName = response.data.customer.last_name;
            instance.email = response.data.customer.email;
            instance.phoneNumber = response.data.customer.phone_number;
            instance.address = response.data.customer.address;
            instance.company = response.data.customer.company;
            instance.tinNumber = response.data.customer.tin_number;
            instance.customerGroup = response.data.customer.customer_group;
            instance.setPreLoader(true);
          },
          function (response) {
            instance.setPreLoader(true);
          },
      );
    },
    tipoClienteRdb(value) {
      this.tipoCliente = value;
      if (parseInt(this.tipoCliente) === 1) {
        this.tipoClienteE = '';
        this.tipoClienteP = true;
        this.tipoCliente = 'P';
      } else {
        this.tipoClienteP = '';
        this.tipoClienteE = true;
        this.tipoCliente = 'E';
      }
    },
  },
}
</script>