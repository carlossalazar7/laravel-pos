<template>

    <div>
        <div class="modal-layout-header">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-10">
                        <h4 class="m-0">{{ trans('lang.register_info') }}</h4>
                    </div>
                    <div class="col-2 text-right">
                        <button type="button" class="close" @click.prevent="closeModal">
                            <i class="la la-close icon-modal-cross"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-layout-content">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio"
                       name="ordenes_pagadas"
                       class="custom-control-input"
                       id="ordenes_pagadas"
                       checked="checked"
                       @click="cambiarEstadoOrdenes(0)"
                       value="D"
                       v-model="ordenesEstado"/>
                <label class="custom-control-label"
                       for="ordenes_pagadas">
                    {{ trans('lang.ordenes_pagadas') }}
                </label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio"
                       name="ordenes_preparacion"
                       class="custom-control-input"
                       id="ordenes_preparacion"
                       checked="checked"
                       @click="cambiarEstadoOrdenes(1)"
                       value="EP"
                       v-model="ordenesEstado"/>
                <label class="custom-control-label"
                       for="ordenes_preparacion">
                    {{ trans('lang.ordenes_preparacion') }}
                </label>
            </div>
            <br><br>

            <div class="mb-1 d-none" :class="{'d-block': isCashRegisterBalanceInfo}">
                <div>
                    <span class="info-heading">{{ trans('lang.cash_opening_balance') }} :</span>
                    <span class="info-value">{{ numberFormat(cashRegisterSalesBalance.opening_amount) }}</span>
                </div>
                <div>
                    <span class="info-heading">{{ trans('lang.total_sales') }} :</span>
                    <span class="info-value">{{ numberFormat(cashRegisterSalesBalance.total_sales) }}</span>
                </div>
                <div>
                    <span class="info-heading">{{ trans('lang.total_cash_sales') }} :</span>
                    <span class="info-value">{{ numberFormat(cashRegisterSalesBalance.total_cash_sale) }}</span>
                </div>
            </div>
            <datatable-component class="datatable-cash-register-info d-block ordenesPagadas"
                                 :options="tableOptions"/>
            <br>
            <datatable-component class="datatable-cash-register-info d-none ordenesPreparacion"
                                 :options="tableOptions2"/>
        </div>
    </div>
</template>

<script>
import axiosGetPost from '../../../helper/axiosGetPostCommon';

export default {
    extends: axiosGetPost,
    props: ['modalID', 'current_branch'],
    data: () => ({
        isCashRegisterBalanceInfo: false,
        cashRegisterSalesBalance: '',
        tableOptions: {},
        tableOptions2: {},
        ordenesEstado: 'D',
        hasData: value => {
            return !_.isEmpty(value)
        },
    }),
    created() {
        this.getRegisterInfo();
        this.cashSalesBalance();
    },
    methods: {
        cambiarEstadoOrdenes(value) {
            console.log(value);
            const boxes1 = document.getElementsByClassName("ordenesPreparacion");
            const boxes2 = document.getElementsByClassName("ordenesPagadas");
            if (value === 0) {
                boxes2[0].classList.remove("d-none");
                boxes2[0].classList.add("d-block");
                boxes1[0].classList.remove("d-block");
                boxes1[0].classList.add("d-none");
            } else {
                boxes1[0].classList.remove("d-none");
                boxes1[0].classList.add("d-block");
                boxes2[0].classList.remove("d-block");
                boxes2[0].classList.add("d-none");
            }
        },
        getRegisterInfo() {
            let instance = this;

            instance.tableOptions = {
                tableName: 'products',
                columns: [
                    {
                        title: 'lang.invoice_id',
                        type: "component",
                        componentName: "datatable-invoice-modal-component",
                    },
                    {
                        title: 'lang.sold_to',
                        key: 'customer',
                        type: 'text',
                        sortable: true
                    },
                    {
                        title: 'lang.total',
                        key: 'total',
                        type: 'text'
                    },
                ],
                clickAbleModel: true,
                sortedBy: 'id',
                sortedType: 'DESC',
                right_align: ['total'],
                formatting: ['total'],
                source: '/register-sales-info/' + instance.current_branch,
            }

            instance.tableOptions2 = {
                tableName: 'products',
                columns: [
                    {
                        title: 'lang.invoice_id',
                        key: 'invoice_id',
                        type: "text",
                    },
                    {
                        title: 'lang.sold_to',
                        key: 'customer',
                        type: 'text',
                        sortable: true
                    },
                    {
                        title: 'lang.total',
                        key: 'total',
                        type: 'text'
                    },
                ],
                clickAbleModel: true,
                sortedBy: 'id',
                sortedType: 'DESC',
                right_align: ['total'],
                formatting: ['total'],
                source: '/register-sales-info-preparacion/' + instance.current_branch,
            }
        },
        cashSalesBalance() {
            let instance = this;
            instance.axiosGet('/cash-register-total-sales-balance/' + instance.current_branch,
                function (response) {
                    instance.cashRegisterSalesBalance = response.data;
                    instance.isCashRegisterBalanceInfo = true;
                })
        },
        closeModal() {
            $('#register-info-modal').modal('hide');
        }
    }
}
</script>
