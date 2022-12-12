$("#confirmBtn").on('click', function() {
    $pin = $("#pinInput").val()
    $form = $("#transfer-form")
    $profile_type = $(this).attr("data-type")

    let $url = '/tranfer/pin';
    if ($pin != null && $pin != "" && !isNaN($pin)) {
        if ($pin.length == 4)
        {
            $("#pinError").html("")
            $("#pinInput").removeClass("is-invalid")
            let $token = $('input[name="_token"]').val();


            fetch($url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": $token
                    },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    pin: $pin
                })
            })
            .then(response => {
                if (!response.ok) {
                    return Promise.reject(response);
                }
                return response.json();
            })
            .then((data) => {
                if (data.status) {
                    $form.submit()
                } else {
                    if (data.type == "error") {
                        $("#pinError").html(data.message)
                        $("#pinInput").addClass("is-invalid")
                    } else if (data.type == "pin") {
                        $("#pinError").html(`
                            ${data.message}. Click <a href="/${$profile_type}/profile/settings/check" target="_blank">here</a> to create pin.
                        `)
                        $("#pinInput").addClass("is-invalid")
                    }
                }

            })
            .catch(function(error) {
                if (typeof error.json === "function") {
                    error.json().then(jsonError => {
                        console.log(jsonError);
                    }).catch(genericError => {
                        console.log(error.statusText);
                    });
                } else {
                    console.log(error);
                }
            });


        } else {
            $("#pinError").html("Pin must be 4 digits")
            $("#pinInput").addClass("is-invalid")
        }
    } else if (isNaN($pin)) {
        $("#pinError").html("Pin must be a number")
        $("#pinInput").addClass("is-invalid")
    } else if ($pin != null && $pin != "") {
        $("#pinError").html("Please enter a pin")
        $("#pinInput").addClass("is-invalid")
    }
})