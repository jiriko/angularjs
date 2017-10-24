import angular from 'angular'
import { StudentIndexModule, StudentCreateModule } from './student'
import { SubjectIndexModule } from './subject'
import { SortableHeaderModule } from './partials'

//console.log(SortableHeader)
export const ComponentsModule = angular
    .module('app.components', [
        SortableHeaderModule,
        SubjectIndexModule,
        StudentIndexModule,
        StudentCreateModule
    ])
    .name