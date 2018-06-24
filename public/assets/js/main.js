(function($){

    'use strict';

    const login = (e) => {

        e.preventDefault();

        let username = $('#username').val();
        let password = $('#password').val();

        if( validateData(username, 'string') && validateData(password, 'string') ){

            $.ajax({
                method: 'post',
                url: '/login',
                data: {
                    username: username,
                    password: password
                }
            }).done( (response ) => {

                try {
                    response = JSON.parse(response);
                    if( response.type === 'error' ){
                        $('#loginError').text(response.message).removeClass('d-none');
                    }
                    else if( response.type === 'success' ){
                        window.location.href = 'profile';
                    }
                } catch (e) {
                    console.log(e);
                }


            })
            .fail( (error) => {
                console.log(error);
                $('#loginError').text(error).removeClass('d-none');
            });

        }else{
            console.log('Login data not valid!');
        }

    };

    const register = (e) => {

        e.preventDefault();

        let username    = $('#reg_username').val();
        let email       = $('#reg_email').val();
        let password    = $('#reg_password').val();
        let password_confirm   = $('#password_confirm').val();

        if( validateData(username, 'string') && validateData(email, 'string') &&
            validateData(password, 'string') &&  validateData(password_confirm, 'string') &&
            password === password_confirm
        ){

            $.ajax({
                method: 'post',
                url: '/register',
                data: {
                    username: username,
                    email: email,
                    password: password,
                    password_confirm: password_confirm
                }
            }).done( (response) => {

                try {
                    response = JSON.parse(response);
                    if( response.type === 'error' ){
                        $('#registerError').text(response.message).removeClass('d-none');
                    }
                    else if( response.type === 'success' ){
                        window.location.href = 'profile';
                    }
                } catch (e) {
                    console.log(e);
                }

            })
            .fail( (error) => {
                console.log(error);
                $('#registerError').text(error).removeClass('d-none');
            });

        }else{
            console.log('Register data not valid!');
        }

    };

    const validateData = (data, type) => {
        return (typeof data === type && data.length > 0)
    };

    $('#loginSubmit').on('click', login);
    $('#registerSubmit').on('click', register);

})(jQuery);