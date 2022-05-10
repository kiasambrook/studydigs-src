<?php

// Create a session 
session_start();
/**
 * Define the user types.
 */
define("AUTHORISED", 'authorised');
define("UNAUTHORISED", 'unauthorised');
define("ADMIN", 'admin');
define("GENERAL", 'general');


/**
 * Create a flash method to be displayed.
 *
 * @param string $name - The name of flash message.
 * @param string $message - The message to be displayed.
 * @param string $class - The class to apply to the message.
 * @return void
 */
function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION['name']);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } else if (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ?  $_SESSION[$name . '_class'] : '';
            echo '<div class ="' . $class . ' id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            $_SESSION[$name . '_class'];
        }
    }
}

/**
 * Check whether Admin is logged in.
 *
 * @return Boolean - true if logged in or false if not
 */
function isLoggedIn()
{
    if (isset($_SESSION['user_type'])) {
        if ($_SESSION['user_type'] == ADMIN) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * Check whether user is logged in.
 *
 * @return Boolean - true if logged in or false if not
 */
function userLoggedIn()
{
    if (isset($_SESSION['user_type'])) {
        if ($_SESSION['user_type'] == AUTHORISED) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * Destroy the user session.
 *
 * @return void
 */
function userLogout()
{
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    session_destroy();
}

/**
 * Destroy teh admin session.
 *
 * @return void
 */
function adminLogout()
{
    unset($_SESSION['user_type']);
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['user_fname']);
    session_destroy();
}
