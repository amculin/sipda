$('a.modal-trigger').click(function(event) {
    event.preventDefault();
    var url = $(this).attr('href');
    var size = $(this).attr('data-bs-size');

    $.ajax({
        url : url,
        type : 'POST',
        success : function(data) {
            if (size != 'undefined') {
                $('div#modal-form div.modal-dialog').addClass('modal-' + size);
            }

            $('div#modal-form div.modal-dialog div.modal-content').html(data);
        }
    });
});

$('#modal-form').on('hidden.bs.modal', function (e) {
    $('div#modal-form div.modal-dialog').removeClass('modal-lg');
})