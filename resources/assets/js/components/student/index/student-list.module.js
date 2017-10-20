import angular from 'angular'
import StudentListComponent from './student-list.component'
import {ngSweetAlert2} from 'angular-h-sweetalert';
import uiBootstrap from 'angular-ui-bootstrap'
import { AddSubject } from "./add-subject.module";

const StudentListModule = angular
    .module('StudentListModule',[ngSweetAlert2, uiBootstrap, AddSubject])
    .component('studentList', StudentListComponent)
    .name

export default StudentListModule