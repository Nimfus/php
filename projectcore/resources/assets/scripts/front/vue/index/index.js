Vue.component('index-component', {
    template: '#index',
    created: function() {
        this.init();
    },
    data: function () {
        return {
            user: {
                name: '',
                avatar: '',
                id: null
            }
        }
    },
    methods: {
        like: function(userId) {
            this.$http.get('/users/' + userId + '/like', {params : {}})
                .then(function (response) {
                    this.init();
                }, function () {

                }).finally(function () {

            });
        },
        chat: function(userId) {
            this.$http.post('/threads/' + userId, {params : {}})
                .then(function (response) {
                    bus.$emit('thread-created', response)
                }, function () {

                }).finally(function () {

            });
        },
        skip: function() {
            this.init();
        },
        init: function() {
            this.$http.get('/users/show', {params : {}})
                .then(function (response) {
                    this.user = response.body.user;
                }, function () {

                }).finally(function () {

            });
        }
    }
});