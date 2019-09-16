<html>
    <head>
        <title>Login Page</title>
    </head>
    <body>
        <?php
        echo form_fieldset("Login Form");
        echo validation_errors();
        
        $form_attributes = array (
            "class" => "login-form",
            "id"    => "login-form"
        );
        echo form_open("auth/login", $form_attributes);
        echo form_input("username", "Username");
        echo form_password("password", "Password");
        echo form_submit("login", "Login");
        echo form_close();
        echo form_fieldset_close();
        ?>
    </body>
</html>

