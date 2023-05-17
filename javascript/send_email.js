////-- JAVASCRIPT FOR SENDING EMAILS THROUGH FORMS

$(document).ready(function () { // if document is ready

    // if email is submitted
    // users cannot submit form if value is invalid because of the "required" attribute in HTML tag
    $('#feedback_form').on('submit', function (submit) { 

        submit.preventDefault(); // prevent the refreshing of page when submitting the form

        $.ajax({ // use ajax for sending the email

            method: 'POST', // type method as POST 
            url: 'https://formsubmit.co/ajax/bytedelightofficial@gmail.com', // url for sending the message to bytedelightofficial@gmail.com
            dataType: 'json', // set data type to json
            accepts: 'application/json', // set the accepted data to application/json

            // set data to send through email
            data: {
                Email: $('input[name="Email"]').val(), // get email from the value of input[name="Email"]
                Name: $('input[name="Name"]').val(), // get name from the value of input[name="Name"]
                Subject: $('input[name="Subject"]').val(), // get subject from the value of input[name="Subject"]
                Message: $('textarea[name="Message"]').val() // get message from the value of input[name="Message"]
            },

            // if sending email is a success, do this function
            success: function () {
                $('#feedback_form').trigger('reset'); // reset the values of form to blank
            }
        });
    });

});