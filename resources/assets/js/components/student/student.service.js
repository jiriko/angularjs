class StudentService {
    constructor($http) {
        'ngInject'
        this.$http = $http
    }

    all() {
        return this.$http.get('/api/students').then((response) => {
            return response.data
        })
    }

}

export default StudentService