import angular from 'angular'
import uiRouter from 'angular-ui-router'
import StudentCreateComponent from './student-create.component'

export const StudentCreateModule = angular
    .module('StudentCreate', [uiRouter])
    .component('studentCreate', StudentCreateComponent)
    .config(($stateProvider, $urlRouterProvider) => {
        'ngInject';
        $stateProvider
            .state('students-create', {
                url: '/students/new',
                component: 'studentCreate',
            })
        $urlRouterProvider.otherwise('/')
    })
    .name