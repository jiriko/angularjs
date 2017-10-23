import angular from 'angular';
import { StudentIndexModule, StudentCreateModule } from './student';

export const ComponentsModule = angular
    .module('app.components', [
        StudentIndexModule,
        StudentCreateModule
    ])
    .name;