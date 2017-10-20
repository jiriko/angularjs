import angular from 'angular';
import { StudentIndexModule } from './student';
export const ComponentsModule = angular
    .module('app.components', [
        StudentIndexModule
    ])
    .name;