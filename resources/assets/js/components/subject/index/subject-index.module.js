import angular from 'angular'
import SubjectIndexComponent from './subject-index.component'
export const SubjectIndexModule = angular
    .module('SubjectIndex', [])
    .component('subjectIndex', SubjectIndexComponent)
    .config(($stateProvider, $urlRouterProvider) => {
        'ngInject';
        $stateProvider
            .state('subjects-index', {
                url: '/subjects',
                component: 'subjectIndex',
            })
    })
    .name