import template from './student-index.html'

const StudentIndexComponent = {
    bindings: {
        studentResource: '<',
    },
    template,
    controller: class StudentIndexComponent {
        constructor($state) {
            'ngInject'
        }

        $onInit() {
            this.students = _.clone(this.studentResource.data)
            this.links = _.clone(this.studentResource.links)
            this.meta = _.clone(this.studentResource.meta)
        }
    }
}

export default StudentIndexComponent