import template from './student-create.html'

const StudentCreateComponent = {
    template,
    controller: class StudentCreateComponent {
        constructor($state, swal, StudentService, EnrollmentService) {
            'ngInject'
            this.swal = swal
            this.studentService = StudentService
            this.enrollmentService = EnrollmentService
        }
    }
}

export default StudentCreateComponent