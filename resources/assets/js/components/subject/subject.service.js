class SubjectService {
    constructor($http, swal) {
        'ngInject'
        this.$http = $http
        this.swal = swal
    }

    all(name) {
        return this.$http.get('/api/subjects?name=' + name).then((response) => {
            return response.data
        })
        .catch(() => {})
    }
}

export default SubjectService