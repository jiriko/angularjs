import template from './subject-index.html'

const SubjectIndexComponent = {
    template,
    controller: class SubjectIndexComponent {
        constructor($state, swal ) {
            'ngInject'
            this.swal = swal
        }
    }
}

export default SubjectIndexComponent