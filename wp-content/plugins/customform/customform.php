<?php

/*
 * Plugin Name: Кастом форма
 */

function createForm() {
    echo '
    <div class="form">
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    <div>
    <label for="username">Username <strong>*</strong></label>
    <input type="text" name="username" placeholder="Имя пользователя">
    </div>
      
    <div>
    <label for="password">Password <strong>*</strong></label>
    <input type="password" name="password" placeholder="Пароль">
    </div>
      
    <div>
    <label for="email">Email <strong>*</strong></label>
    <input type="text" name="email" placeholder="Почта">
    </div>
      
    
    <input type="submit" name="submit" value="Register"/>
    </form>
    </div>
    ';
}

/**
 * @param $username
 * @param $password
 * @param $email
 * @return void
 *
 * Check all needle fields for mistakes
 * If there are errors, render message with them
 */
function validate($data) {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if (empty($data[0]) || empty($data[1]) || empty($data[2])) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    if (4 > strlen($data[0])) {
        $reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
    }

    if (username_exists($data[0])) {
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

/**
 * @param $data
 * @return void
 *
 * If there is no registration errors, build an array and insert the user,
 * then if there is WP_Error, throwing the Die exception
 */
function register($data)
{
    global $reg_errors;

    if (1 > count($reg_errors->get_error_messages())) {
        $userdata = [
            'user_login' => $data[0],
            'user_email' => $data[1],
            'user_pass' => $data[2],
        ];

        $user = wp_insert_user($userdata);

        if (is_wp_error($user)) {
            wp_die($user->get_error_message());
        } else {
            echo '<p class="form-state">Registration complete. Goto <a href="/">main page</a>.</p>';
        }
    }
}

/*
 * If the request method is POST:
 *     1) Getting all needle params and sanitizing them
 *     2) Validating them by built-in WP functions
 *     3) If there is no WP_Error, insert into DB with WP
 * Else:
 *     1) Only render HTML registration form
 */
function registration() {
    if (isset($_POST['submit'])) {
        $data = [
            'username' => sanitize_user($_POST['username']),
            'password' => esc_attr($_POST['password']),
            'email' => sanitize_email($_POST['email']),
        ];

        validate($data);
        register($data);
    }

    createForm();
}

/*
 * Creating shortcode to use form plugin everywhere in WP project
 *
 * Calling: registration()
 */
function custom_registration_shortcode() {
    ob_start();
    registration();
    return ob_get_clean();
}
add_shortcode('plugin_reg', 'custom_registration_shortcode');