import angular from 'angular'
import AddSubjectComponent from './add-subject.component'

export const AddSubject = angular
    .module('AddSubject', [])
    .component('addSubject', AddSubjectComponent)
    .name