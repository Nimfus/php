var Login = {
    template: '#login-component',
    created: function () {
    },
    data: function () {
        return {
            email: null,
            password: null,
            remember: false
        }
    },
    methods: {
        rememberMe: function () {
            this.remember = this.remember !== true;
        }
    }
};