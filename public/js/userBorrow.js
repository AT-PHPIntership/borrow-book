quantityLang = Lang.get('borrow.quantity');
limit = 8;
url = '/api/users/borrow?limit=' + limit;
function getUserBorrows(url) {
    $.ajax({
        url: url,
        type: 'get',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
        },
        success: function(response) {
            const BORROWING = 0;
            const GIVE_BACK = 1;
            const WAITTING = 2;
            const CANCEL = 3;
            response.data.forEach(borrows => {
                let from_date = borrows.from_date;
                let to_date = borrows.to_date;
                let idBorrow = "borrow" + borrows.id;
                $('#template-borrow').clone().attr({"style":"display: ", "id": idBorrow}).insertBefore('#template-borrow');
                $("#"+ idBorrow +" .from-date").text(from_date);
                $("#"+ idBorrow +" .to-date").text(to_date);
                borrows.borrow_details.forEach(borrow_detail => {
                    let idBorrowDetail = borrow_detail.id;
                    let title = borrow_detail.book.title;
                    let quantity = quantityLang + ': ' + + borrow_detail.quantity;
                    $("#"+ idBorrow + " #template-borrow-detail").clone().attr({"style":"display: ", "id": "borrow-detail" + idBorrowDetail}).insertBefore('#'+ idBorrow +' #template-borrow-detail');
                    $("#"+ idBorrow + " #borrow-detail"+ idBorrowDetail +" .borrow-detail .book-title").text(title);
                    $("#"+ idBorrow + " #borrow-detail"+ idBorrowDetail +" .borrow-detail .book-quantity").text(quantity);
                });
                $("#"+ idBorrow +" .btn_cancel .btn-cancel").attr({"borrow-id": borrows.id });
                if (borrows.status == BORROWING) {
                    $("#"+ idBorrow +" .status .label-success").show();
                } else if (borrows.status == GIVE_BACK) {
                    $("#"+ idBorrow +" .status .label-primary").show();
                   
                } else if (borrows.status == WAITTING) {
                    $("#"+ idBorrow +" .status .label-warning").show();
                     $("#"+ idBorrow +" .btn_cancel .btn-cancel").show();
                } else {
                    $("#"+ idBorrow +" .status .label-danger").show();
                }
            });
        }   
    });
}
function cancelBorrow(borrowId) {
    let note = '';
    if ($('#note').val()) {
        note = $('#note').val();
    }
    $.ajax({
        url: 'api/borrow/' + borrowId,
        type: "put",
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
        },
        data: {
            "content": note,
        },
        success: function(response) {
            $('#table-content .table tbody tr[id="borrow' + response.id + '"] .status .label-warning').hide();
            $('#table-content .table tbody tr[id="borrow' + response.id + '"] .status .label-danger').show();
            $('#table-content .table tbody tr[id] .btn_cancel button[borrow-id="' + response.id + '"]').hide();
            $('#note').val('');
            $('#table-content .table tbody tr[id="borrow' + response.id + '"] .done').show();
        },
        statusCode: {
            500: function(response) {
                $('#table-content .table tbody tr[id="borrow' + response.id + '"] .error lb-error').html(response.responseJSON.message);
                $('#table-content .table tbody tr[id="borrow' + response.id + '"] .error').show();
            }
        }
    });
}
$(document).ready(function() {
    getUserBorrows(url);
    $(document).on('click', '#table-content .table tbody tr[id] .btn_cancel button[borrow-id]', function(event) {
    event.preventDefault();
        if (confirm(Lang.get('auth.cancel_confirm'))) {
            $('#note_cancel_submit').attr('borrow-id', $(this).attr('borrow-id'));
            $('#note_cancel').modal('show');
        }
    });
    $(document).on('click', '#note_cancel .note_cancel .modal-body input[id="note_cancel_submit"][borrow-id]', function(event) {
    event.preventDefault();
        cancelBorrow($(this).attr('borrow-id'));
        $('#note_cancel').modal('hide');
    });
});
