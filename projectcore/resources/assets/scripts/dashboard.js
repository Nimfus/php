$('#removeItemModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget),
        id = button.data('id'),
        model = button.data('model'),
        route = button.data('route'),
        modal = $(this);

    modal.find('.modal-title').text('Are you sure you want to delete selected ' + model + '?');
    modal.find('.modal-footer form').attr('action', route);
});

$(document).ready(function() {
    $('#summernote').summernote({
        height: 300,
    });
});