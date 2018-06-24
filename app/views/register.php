<?php
if ( isset($data['home']) && ! $data['home'] ){
	require_once 'header.html';
}
?>
        <div class="col">
            <h2>Register form</h2>
            <form id="registerForm" class="form">
                <div class="form-group">
                    <label for="reg_username">
                        <input type="text" id="reg_username" class="form-control" placeholder="username" required />
                    </label>
                </div>
                <div class="form-group">
                    <label for="reg_email">
                        <input type="email" id="reg_email" class="form-control" placeholder="email@provider.com" required />
                    </label>
                </div>
                <div class="form-group">
                    <label for="reg_password">
                        <input type="password" id="reg_password" class="form-control" placeholder="password" required />
                    </label>
                </div>
                <div class="form-group">
                    <label for="password_confirm">
                        <input type="password" id="password_confirm" class="form-control" placeholder="password" required />
                    </label>
                </div>
                <input id="registerSubmit" type="submit" class="btn btn-primary" value="Register" />
                <div id="registerError" class="alert alert-danger d-none"></div>
            </form>
        </div>


<?php
if ( isset($data['home']) && ! $data['home'] ){
	require_once 'footer.html';
}
?>