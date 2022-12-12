$('#accountAddress').on('change', function() {
    if ($(this).val() != "" && $(this).val() != null) {
        fetchName($(this).val())
    } 

})

$address = false;

$(window).on('load', function() {
    if ($('#accountAddress').val() != "" && $('#accountAddress').val() != null) {
        console.log('hello');
        fetchName($('#accountAddress').val())
    } 
}) 


function fetchName(payload) {
    if (payload != '' && payload != null) {
        $myAddress = $('#accountAddress').attr('data-address')
        
        if (payload == $myAddress) {
            $('#errorBox').html("Error: You cannot transfer funds to yourself")
            $('#errorBox').css('display', 'block')
            $address = false;
        } else {
            fetch(`/profile/api/${payload}`)
                .then(response => {
                    if (!response.ok) {
                        return Promise.reject(response);
                        // throw new Error('Account not found. Please make sure the account address is correct.');
                    }
                    return response.json();
                })
                .then(data => {
                    $('#accountName').val(data.name)
                    $('#errorBox').html('')
                    $('#errorBox').css('display', 'none')
                    $address = true;
                })
                .catch(function(error) {
                    if (typeof error.json === "function") {
                        error.json().then(jsonError => {
                            $('#errorBox').html(jsonError)
                        }).catch(genericError => {
                            $('#errorBox').html(error.statusText)
                        });
                    } else {
                        $('#errorBox').html(error)
                    }
                    
                    $('#errorBox').css('display', 'block')
                    $address = false;
                });
        }
    }
}




$('#transfer-form').on('keyup', function() {
    if (($('#accountAddress').val() != "" && $('#accountAddress').val() != null) && ($('#accountNumber').val() != "" && $('#accountNumber').val() != null)) {
        if ($address && !isNaN($('#accountNumber').val())) {
            $("#submitBtn").attr('disabled', false)
        } else {
            $("#submitBtn").attr('disabled', true)
        }
    } else {
        $("#submitBtn").attr('disabled', true)
    }
});