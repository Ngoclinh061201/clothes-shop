
function changeCity(){
    var city = $('#user_city').val();
    $.ajax({
        type: "POST",
        url: DOMAIN_URL + 'get-districts-by-city',
        data: {
            'code_city': city,
        },
        dataType: "json",
        success: function (result) {
            $('#district').find('option').remove().end();
            result.forEach((element) => {
                $('#district').append($('<option>', {
                    value: element.id,
                    text : element.name
                }));
            });
        },
        error: function (e) {
            console.log(e);
        }
    });
}

$('#place-order').click(function() {
    var city = $('#user_city').val();
    var district = $('#district').val();
    var fullName = $('#full_name').val();
    var numberPhone = $('#user_phone').val();
    var addressDetail = $('#user_address').val();
    $.ajax({
        type: "POST",
        url: DOMAIN_URL + 'place-order',
        data: {
            'code_city': city,
            'district': district,
            'full_name': fullName,
            'number_phone': numberPhone,
            'address_detail': addressDetail
        },
        dataType: "json",
        success: function (result) {
            if(result){
                Swal.fire('Order success');
            }
        },
        error: function (e) {
            console.log(e);
        }
    });
});