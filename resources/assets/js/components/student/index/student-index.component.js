import template from './student-index.html'

const StudentIndexComponent = {
    bindings: {
        studentResource: '<',
    },
    template,
    controller: class StudentIndexComponent {
        constructor($state, swal, StudentService, EnrollmentService) {
            'ngInject'
            this.swal = swal
            this.studentService = StudentService
            this.enrollmentService = EnrollmentService
        }

        $onInit() {
            this.query = ''
            this.refreshData(this.studentResource)

            this.fetchStudents = _.debounce(() => {
                this.studentService.all({page: this.currentPage, query: this.query})
                    .then((response) => {
                        this.refreshData(response)
                        window.scrollTo(200, 0);
                    })
            },300)
        }

        searchStudents() {
            this.currentPage = 1
            this.fetchStudents()
        }

        refreshData(response) {
            this.students = _.clone(response.data)
            this.links = _.clone(response.links)
            this.meta = _.clone(response.meta)
            this.currentPage = this.meta.current_page
            this.totalItems = this.meta.total
            this.perPage = this.meta.per_page
        }

        updateStudent({student}) {
            let index = this.students.findIndex(o =>  o.id == student.id)
            this.students.splice(index,1,student)
            this.swal('Success!',student.name + ' has been updated.')
            this.studentService.update(student)
        }

        removeStudent({student}) {
            let index = this.students.findIndex(o =>  o.id == student.id)

            this.students.splice(index,1)

            //It's weird I have to reclone
            this.students = _.clone(this.students)

            this.swal('Success!',student.name + ' has been expelled.')

            this.studentService.delete(student)
        }

        removeSubject({subject, student}) {
            let index = this.students.findIndex(o => o.id == student.id)
            let subjectIndex = this.students[index].subjects.findIndex(o => o.id == subject.id)
            this.students[index].subjects.splice(subjectIndex,1)

            this.enrollmentService.delete(subject.enrollment_id)
                .then(() => {
                    this.swal('Success!',subject.name + ' has been removed.')
                })
        }

        addSubject({subject, student}) {
            return this.enrollmentService.store(student.id, subject.id)
                .then((response) => {
                    let enrollment = _.clone(subject)
                    enrollment.enrollment_id = response.id
                    let index = this.students.findIndex(o => o.id == student.id)
                    this.students[index].subjects.push(enrollment)

                    this.swal('Success!',subject.name + ' has been added.')
                    return response
                })
        }
    }
}

export default StudentIndexComponent