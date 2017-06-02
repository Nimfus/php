var Register = {
    template: '#registration-component',
    created: function () {
    },
    data: function () {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null
        }
    },
    methods: {
        fieldsEmpty: function() {
            return this.name == null || this.email == null || this.password == null || this.password_confirmation == null;
        }
    }
};