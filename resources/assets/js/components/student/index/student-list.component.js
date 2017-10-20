import template from './student-list.html'
import addSubjectForm from './add-subject.html'

console.log(addSubjectForm)

const StudentListComponent = {
    bindings: {
        students: '<'
    },
    template,
    controller: class StudentListComponent {
        constructor(swal, $uibModal) {
            'ngInject'
            this.swal = swal
            this.modal = $uibModal
        }

        $onChanges(changes) {
            if (changes.students) {
                this.students = _.clone(this.students)
            }
        }

        openSubjectForm(student) {
            this.modal.open({
                component: "addSubject",
                resolve: {
                    student() {
                        return student
                    }
                 }
            })
        }

        confirmDeleteStudent() {
            this.swal({
                    title: "Are you sure?",
                    text: "The devil's future is in your shoulders!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, let him suffer!",
                    closeOnConfirm: false
                },
                function () {
                    SweetAlert.swal("Booyah!");
                });
        }
    }
}

export default StudentListComponent