import angular from 'angular'
import uiRouter from 'angular-ui-router'
import StudentIndexComponent from './student-index.component'
import StudentListModule from './student-list.module'
import StudentService from '../student.service'
import EnrollmentService from '../enrollment.service'
import { SortableHeader } from '../../partials'

export const StudentIndexModule = angular
    .module('StudentIndex', [uiRouter, StudentListModule, SortableHeader])
    .component('student', StudentIndexComponent)
    .service('StudentService', StudentService)
    .service('EnrollmentService', EnrollmentService)
    .config(($stateProvider, $urlRouterProvider) => {
        'ngInject';
        $stateProvider
            .state('students-index', {
                url: '/students',
                component: 'student',
                resolve: {
                    studentResource:  StudentService => StudentService.all()
                }
            })
        $urlRouterProvider.otherwise('/')
    })
    .name