import template from './sortable-header.html'

const SortableHeader = {
    bindings: {
        name: '<',
        sortBy: '<',
        sortOrder: '<'
        onSortChange: '&'
    },
    template,
    controller: class SortableHeader {
        constructor() {
            'ngInject'
        }

        changeSort(sortBy) {
            this.onSortChange({
                $event: { sortBy }
            })
        }

        $onChanges(changes) {
            if (changes.name) {
                this.namee = this.name
            }


            if (changes.sortOrder) {
                this.sortOrder = this.sortOrder
            }

            if (changes.sortBy) {
                this.sortBy = this.sortBy
            }
        }
    }
}

export default SortableHeader