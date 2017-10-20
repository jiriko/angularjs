import template from './add-subject.html'

const AddSubjectComponent = {
    bindings: {
        modalInstance: '<',
        resolve: '<',
    },
    template,
    controller: class AddSubjectComponent {
        constructor($state) {
            'ngInject'
        }

        $onInit() {
            this.student = _.clone(this.resolve.student)
            this.instance = this.modalInstance
        }
    }
}

export default AddSubjectComponent