require('./bootstrap');
import './app.scss'

require('angular-xeditable')
import angular from 'angular'
import uiRouter from 'angular-ui-router'
import { AppComponent } from './app.component'
import { ComponentsModule } from './components'
import AngularLoadingBar from 'angular-loading-bar'
import {ngSweetAlert2} from 'angular-h-sweetalert'
import uiBootstrap from 'angular-ui-bootstrap'


/* @ngInject */
export const AppModule = angular
    .module('app',[
        uiBootstrap,
        uiRouter,
        AngularLoadingBar,
        ngSweetAlert2,
        "xeditable",
        ComponentsModule,
    ])
    .component('app', AppComponent)
    .config(cfpLoadingBarProvider => {
        cfpLoadingBarProvider.includeSpinner = false
    })
    .run(editableOptions => {
        editableOptions.theme = 'bs3'
    })
    .name
