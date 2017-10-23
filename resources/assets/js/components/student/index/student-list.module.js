import angular from 'angular'
import StudentListComponent from './student-list.component'
import {ngSweetAlert2} from 'angular-h-sweetalert'
import uiBootstrap from 'angular-ui-bootstrap'
import { AddSubject } from "./add-subject.module"
require('angular-xeditable')

/** ngInject */
const StudentListModule = angular
    .module('StudentListModule',[ngSweetAlert2, uiBootstrap, AddSubject, "xeditable"])
    .component('studentList', StudentListComponent)
    .run(editableOptions => {
        editableOptions.theme = 'bs3'
    })
    .name

export default StudentListModule