import angular from 'angular'
import SortableHeader from './sortable-header.component'


export const SortableHeader = angular
    .module('SortableHeader', [])
    .component('sortableHeader', SortableHeader)
    .name