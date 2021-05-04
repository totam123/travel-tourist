function cardValidation() {
    var valid = true;
    var name = $('#user_name').val();
    var email = $('#user_email').val();
    var cardNumber = $('#card-number').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var cvc = $('#cvc').val();

    $("#error-message").html("").hide();

    if (name.trim() == "") {
        valid = false;
    }
    if (email.trim() == "") {
        valid = false;
    }
    if (cardNumber.trim() == "") {
        valid = false;
    }

    if (month.trim() == "") {
        valid = false;
    }
    if (year.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }

    if (valid == false) {
        $("#error-message")
        .html("<div class='alert alert-danger alert-dismissible' style='margin-bottom:1rem;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>All fields are required</strong></div>").show();
    }

    return valid;
}

Stripe.setPublishableKey("pk_test_51IevYbK7nOehjoyWtEBW4pHkiFgCNrLA2c1q4CEdraYFuyV4kkNm1cteIrCB41sQhyqSyWetndyptgmSLxnFDoGa00diqVSnL0");

function stripeResponseHandler(status, response) {
    if (response.error) {
        $("#submit-btn").show();
        $("#error-message").html(response.error.message).show();
    } else {
        var token = response['id'];
        $("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");
        $("#frmStripePayment").submit();
    }
}

function stripePay(e) {
    e.preventDefault();
    var valid = cardValidation();

    if (valid == true) {
        $("#submit-btn").hide();
        Stripe.createToken({
            number: $('#card-number').val(),
            cvc: $('#cvc').val(),
            exp_month: $('#month').val(),
            exp_year: $('#year').val()
        }, stripeResponseHandler);

        return false;
    }
}