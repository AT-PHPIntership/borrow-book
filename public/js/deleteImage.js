$('.close').click(function() {
    var id = $(this).data("id");
    var token = $(this).data("token");
    msg = Lang.get('book.messages.are_you_sure');
    if (confirm(msg)){
        $.ajax({
            type: 'delete',
            url: '/admin/images/'+id,
            data: {
                'id': id,
                _token: token
            },
            success: function(data) {
                document.getElementById('image'+id).remove();
                document.getElementById('close'+id).remove();
            }
        });
    }
});
