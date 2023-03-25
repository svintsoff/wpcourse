<?php

/*
 * Plugin Name: Кастом форма
 */

function registration_form($username, $password, $email) {
    echo '
    <style>
    div {
        margin-bottom:2px;
    }
      
    input{
        margin-bottom:4px;
    }
    </style>
    ';

    echo '
    <div class="form">
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    <div>
    <label for="username">Username <strong>*</strong></label>
    <input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
    </div>
      
    <div>
    <label for="password">Password <strong>*</strong></label>
    <input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
    </div>
      
    <div>
    <label for="email">Email <strong>*</strong></label>
    <input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
    </div>
      
    
    <input type="submit" name="submit" value="Register"/>
    </form>
    </div>
    ';
}

function registration_validation($username, $password, $email) {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if (empty($username) || empty($password) || empty($email)) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    if (4 > strlen($username)) {
        $reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
    }

    if (username_exists($username)) {
        $reg_errors->add('user_name', 'Sorry, that username already exists!');
    }

    if (is_wp_error($reg_errors)) {
        foreach ($reg_errors->get_error_messages() as $error) {
            echo '<div class="form-state">';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';
            echo '</div>';
        }
    }
}

function complete_registration()
{
    global $reg_errors, $username, $password, $email;
    if (1 > count($reg_errors->get_error_messages())) {
        $userdata = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password,
        );

        $user = wp_insert_user($userdata);

        if (is_wp_error($user)) {
            wp_die($user->get_error_message());
        } else {
            echo 'Registration complete. Goto <a href="/">main page</a>.';
        }
    }
}

function cus_reg_fun() {
    if ( isset($_POST['submit'] ) ) {
        global $username, $password, $email;

        registration_validation(
            $_POST['username'],
            $_POST['password'],
            $_POST['email']
        );

        // sanitize user form input
        $username   =   sanitize_user($_POST['username']);
        $password   =   esc_attr($_POST['password']);
        $email      =   sanitize_email($_POST['email']);

        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration();
    }

    if (!isset($username)) $username = "";
    if (!isset($password)) $password = "";
    if (!isset($email)) $email = "";

    registration_form(
        $username,
        $password,
        $email
    );
}

function custom_registration_shortcode() {
    ob_start();
    cus_reg_fun();
    return ob_get_clean();
}
add_shortcode('plugin_reg', 'custom_registration_shortcode');