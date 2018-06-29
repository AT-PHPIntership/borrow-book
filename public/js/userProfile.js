$(document).ready(function () {
  $.ajax({
    url: "/api/users/profile",
    type: "get",
    headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
    },
    success: function( data ) {
        $('#profile-img').css('background-image', 'url('+ data.data.avatar +')');
        $('#name').append(data.data.name);
        $('#dob').append(data.data.dob);
        $('#email').append(data.data.email);
        $('#identity_number').append(data.data.identity_number);
        $('#address').append(data.data.address);
    }
  });
})
