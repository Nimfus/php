// Dropzone init
var $dropzoneElement = $('body').find('div#photos');
if ($dropzoneElement.length > 0) {
    var photos = new Dropzone("div#photos", {
        url: "/profile",
        autoProcessQueue: false,
        uploadMultiple: false,
        addRemoveLinks: true,
        paramName: "photo",
        maxFilesize: 5,
        maxFiles: 1,
        dictRemoveFile: '<i class="fa fa-remove"></i>',
        sending: function (file, xhr, formData) {
            formData.append("_token", $('[name="_token"]').val());
            formData.append("email", $('[name="email"]').val());
        },
        init: function() {
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
            this.on("success", function(data, response) {
                this.removeAllFiles();
            });
        }
    });

    $('#btn').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        photos.processQueue();
    });
}

Vue.use(VTooltip, {
    defaultClass: 'vue-tooltip-theme',
    tetherOptions: {
        constraints: [
            {
                to: 'window',
                attachment: 'together',
                pin: true
            }
        ]
    }
});
Vue.use(VeeValidate);

Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;

var bus = new Vue();

const application = new Vue({
    el: '#app',
    methods: {

    },
    data: {
        view: 'main'
    },
    components: {
        'login-component': Login,
        'registration-component': Register
    }
});