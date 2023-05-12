<template>
    <div>
        <div class="main-layout-wrapper" v-shortkey="loadSales" @shortkey="globalShortcutMethod()">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent m-0">
                    <li class="breadcrumb-item">
                        <span>{{ trans('lang.guides') }}</span>
                    </li>
                </ol>
            </nav>
            <div class="main-layout-card">
                <div class="custom-tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item d-flex justify-content-center" :class="{'active':isSelectedTab(tab.name)}"
                            @click.prevent="selectTab(tab.name, tab.component)" v-if="isVisible(tab.name)" v-for="tab in tabs">
                            <a class="nav-link" href="#customers" @click.prevent="isActive = 1"> {{ trans(tab.lang) }} </a>
                        </li>
                        <li class="nav-item d-flex justify-content-center">AAAAAAAAAAAAAAAAA</li>
                    </ul>
                </div>
                <transition name="slide-fade" mode="out-in">
                    <component v-if="this.componentName" v-bind:is="this.componentName" :permission="permission"></component>
                </transition>
            </div>
        </div>
    </div>
</template>


<script>
import axiosGetPost from '../../../helper/axiosGetPostCommon';

export default {
    extends: axiosGetPost,
    props: ['done', 'preparacion', 'departamentos'],
    data() {
        return {
            selectedTab: null,
            permission: '',
            componentName: null,
            loadSales: [],

            tabs: [
                {name: "done", lang: "lang.ordenes_pagadas", component: "register-info-modal"},
                {name: "preparacion", lang: "lang.ordenes_preparacion", component: "register-info-modal-preparacion"},
                {name: "departamentos", lang: "lang.departamentos", component: "departments-index"},
            ],
            isVisible: function (tabName) {
                return (this[tabName] === 'manage' || this[tabName] === 'read_only');
            },
            isSelectedTab: function (tabName) {
                return (tabName === this.selectedTab);
            },
        }
    },
    created() {
    },
    methods: {
        selectTab: function (tabName, componentName) {
            this.permission = this[tabName];
            this.selectedTab = tabName;
            this.componentName = componentName;
        },
        initSelectedTab: function () {
            var instance = this;

            this.tabs.forEach(function (tab) {
                if (!instance.selectedTab && instance.isVisible(tab.name)) {
                    instance.selectTab(tab.name, tab.component);
                }
            });
        }
    },
    mounted() {
        this.initSelectedTab();
        this.loadSales = this.shortCutKeyConversion();

        if (this.tab_name) {
            var instance = this;
            this.tabs.forEach(function (tab) {
                if (tab.name == instance.tab_name) {
                    instance.selectTab(tab.name, tab.component);
                }
            });
        }

    }
}
</script>