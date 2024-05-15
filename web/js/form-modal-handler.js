$('a.modal-trigger').click(function(event) {
    event.preventDefault();
    var url = $(this).attr('href');

    $.ajax({
        url : url,
        type : 'POST',
        success : function(data) {
            $('div#modal-form div div.modal-content').html(data);
        }
    });
});