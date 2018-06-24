<?php
if ( isset($data['home']) && ! $data['home'] ){
	require_once 'header.html';
}
?>

        <div class="col">
            <h2>Login form</h2>
            <form id="loginForm" class="form">
                <div class="form-group">
                    <label for="username">
                        <input type="text" id="username" class="form-control" placeholder="username" required />
                    </label>
                </div>
                <div class="form-group">
                    <label for="password">
                        <input type="password" id="password" class="form-control" placeholder="password" required />
                    </label>
                </div>
                <input id="loginSubmit" type="submit" class="btn btn-primary" value="Login" />
                <div id="loginError" class="alert alert-danger d-none"></div>
            </form>
        </div>

<?php
if ( isset($data['home']) && ! $data['home'] ){
	require_once 'footer.html';
}
?>