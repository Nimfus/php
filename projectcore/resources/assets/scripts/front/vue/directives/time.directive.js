Vue.directive('time', {
    inserted: function (el, binding) {
        el.innerHTML = moment(binding.value).format("HH:mm:ss");
    },
    update: function (el, binding) {
        el.innerHTML = moment(binding.value).format("HH:mm:ss");
    }
});