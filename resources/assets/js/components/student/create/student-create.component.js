import template from './student-create.html'
import Form from "../../../util/form";

const StudentCreateComponent = {
    template,
    controller: class StudentCreateComponent {
        constructor($state, swal, StudentService, EnrollmentService, $http, $scope) {
            'ngInject'
            this.swal = swal
            this.studentService = StudentService
            this.enrollmentService = EnrollmentService
            this.$http = $http
            this.$scope = $scope
        }

        $onInit() {
            this.form = new Form({
                name: '',
                email: ''
            }, this.$http, this.$scope)

            this.form.watch(this.form);
        }

        submitStudent() {
            this.form.post('/api/students')
        }
    }
}

export default StudentCreateComponent