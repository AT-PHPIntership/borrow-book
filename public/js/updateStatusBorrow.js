$(document).ready(function () {
    $('.status').click(function () {
        var status = $(this).val();
        var id = $(this).data("id");
        msg = Lang.get('borrow.messages.confirm_delete_message');
        if (confirm(msg)){
            $.ajax({
                url: 'admin/borrows/'+id+'/updateStatus',
                type: 'PUT',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                data: {
                    "status": status
                }
            });
        }
    })
})
