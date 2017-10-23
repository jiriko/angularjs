require('./bootstrap');

import angular from 'angular'
import uiRouter from 'angular-ui-router'
import { AppComponent } from './app.component'
import { ComponentsModule } from './components'
import AngularLoadingBar from 'angular-loading-bar'
import './app.scss'

/* @ngInject */
export const AppModule = angular
    .module('app',[uiRouter, ComponentsModule,AngularLoadingBar])
    .component('app', AppComponent)
    .config(cfpLoadingBarProvider => {
        cfpLoadingBarProvider.includeSpinner = false
    })
    .name
