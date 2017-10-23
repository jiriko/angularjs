import angular from 'angular'
import AddSubjectComponent from './add-subject.component'
import SubjectService from "../../subject/subject.service";

export const AddSubject = angular
    .module('AddSubject', [])
    .component('addSubject', AddSubjectComponent)
    .service('SubjectService', SubjectService)
    .name