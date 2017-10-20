require('./bootstrap');

import angular from 'angular'
import uiRouter from 'angular-ui-router'
import { AppComponent } from './app.component'
import { ComponentsModule } from './components'
import './app.scss'

export const AppModule = angular
    .module('app',[uiRouter, ComponentsModule])
    .component('app', AppComponent)
    .name
