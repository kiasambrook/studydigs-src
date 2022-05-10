<?php

/**
 * Users is a class that extends the Controller class that controls the User registering and login related functions.
 *
 * The class will handle functions regarding  login, registering, and verifying email.
 */
class Users extends Controller
{
    /**
     * The __construct magic method is instantiate a User object.
     *
     * When called, user and company models are instantiated to
     * connect to the database.
     */
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
    }

    /**
     * Handles the creation of a user account by inserting the data into the users table.
     *
     * @return void
     */
    public function register()
    {

        if (!userLoggedIn()) :
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form

                // Sanitise POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Innit data
                $data = [
                    'fname' => trim($_POST['fname']),
                    'lname' => trim($_POST['lname']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'checkbox_err' => '',
                    'vkey' => '',
                ];

                $data = $this->validateRegistrationData($data);


                // Ensure there are no errors
                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['checkbox_err'])) {
                    // hash the password
                    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

                    // Generate verification key
                    $data['vkey'] = md5(time() . $data['fname']);

                    // Register user
                    if ($this->userModel->register($data)) {
                        // store user details in a session
                        $user = $this->userModel->getUserByEmail($data['email']);
                        $this->createUserSession($user, UNAUTHORISED);
                        redirect('users/registerbusiness');
                    } else {
                        die("something went wrong");
                    }
                } else {
                    // Load the view with errors
                    $this->view('users/register', $data);
                }
            } else {
                // Innit data
                $data = [
                    'fname' => '',
                    'lname' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'fname_err' => '',
                    'lname_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];

                $this->view('users/register', $data);
            }
        else :
            redirect('dashboard');

        endif;
    }

    /**
     * Finds errors in the user input and returns the data.
     *
     * @param array $data - Array of the data to validate.
     * @return array - The data array returned with errors.
     */
    private function validateRegistrationData($data)
    {
        // Validate email
        if (empty($data['email'])) {
            $data['email_err'] = 'Please enter email';
        } else {
            // Check email exists
            if ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'Email is already taken, please try again';
            }
        }

        // Validate name
        if (empty($data['fname'])) {
            $data['fname_err'] = 'Please enter a first name';
        }
        if (empty($data['lname'])) {
            $data['lname_err'] = 'Please enter a last name';
        }

        // Validate password
        if (empty($data['password'])) {
            $data['password_err'] = 'Please enter password';
        } else if (strlen($data['password']) < 6) {
            $data['password_err'] = 'Password must be at least 6 characters!';
        }

        // Validate confirm password
        if (empty($data['confirm_password'])) {
            $data['confirm_password_err'] = 'Please confirm password';
        } else {
            if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Passwords do not match';
            }
        }

        // Validate checkbox
        if (!isset($_POST['terms'])) {
            $data['checkbox_err'] = 'To continue, you must agree to the terms and conditions';
        }

        return $data;
    }

    /**
     * Handles the creation of a business account by inserting the data into the companys table.
     *
     * @return void
     */
    public function registerBusiness()
    {
        if (!userLoggedIn()) :

            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form

                // Sanitise POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Innit data
                $data = [
                    'name' => trim($_POST['name']),
                    'address' => trim($_POST['address']),
                    'address2' => trim($_POST['address2']),
                    'town' => trim($_POST['town']),
                    'postcode' => trim($_POST['postcode']),
                    'telephone' => trim($_POST['telephone']),
                    'email' => trim($_POST['email']),
                    'logo_path' => '',
                    'name_err' => '',
                    'address_err' => '',
                    'address2_err' => '',
                    'town_err' => '',
                    'postcode_err' => '',
                    'telephone_err' => '',
                    'email_err' => '',
                ];

                // Validate name
                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter company name';
                }

                // Validate address
                if (empty($data['address'])) {
                    $data['address_err'] = 'Please enter an address';
                }
                if (empty($data['town'])) {
                    $data['town_err'] = 'Please enter a town name';
                }

                if (empty($data['postcode'])) {
                    $data['postcode_err'] = 'Please enter a postcode';
                }

                if (empty($data['telephone'])) {
                    $data['telephone_err'] = 'Please enter a telephone';
                }

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter an email';
                }

                // Ensure there are no errors
                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['address_err']) && empty($data['town_err']) && empty($data['postcode_err']) && empty($data['telephone_err']) && empty($data['email_err'])) {

                    // move the logo file if its uploaded
                    if (($_FILES['logo']['name'] != "")) {
                        // download image
                        $file = $_FILES['logo'];
                        $file_name = $file['name'];
                        $path =  $_SERVER['DOCUMENT_ROOT']  . "/studydigs/public/img/logos/" . basename($file_name);
                        move_uploaded_file($file['tmp_name'], $path);
                        $data['logo_path'] = $path;
                    }

                    // Register user
                    if ($this->companyModel->register($data)) {
                        $this->userModel->updateCompanyId($_SESSION['user_id'], $this->companyModel->getCompanyByEmail($data['email']));
                        redirect('users/verify');
                    } else {
                        die("something went wrong");
                    }
                } else {
                    // Load the view with errors
                    $this->view('users/registerbusiness', $data);
                }
            } else {
                // Innit data
                $data = [
                    'name' => '',
                    'address' => '',
                    'address2' => '',
                    'town' => '',
                    'postcode' => '',
                    'telephone' => '',
                    'email' => '',
                    'name_err' => '',
                    'address_err' => '',
                    'address2_err' => '',
                    'town_err' => '',
                    'postcode_err' => '',
                    'telephone_err' => '',
                    'email_err' => '',
                ];

                $this->view('users/registerbusiness', $data);
            }
        else :
            redirect('dashboard');

        endif;
    }

    /**
     * Send an email to the user asking them to verify their account. 
     *
     * @return void
     */
    public function verify()
    {
        if (!userLoggedIn()) :
            $data = [
                'user_name' => $_SESSION['user_name'],
                'user_email' => $_SESSION['user_email'],
            ];

            $user = $this->userModel->getUserByEmail($_SESSION['user_email']);

            // send verification email with link
            $to  = "$user->email";
            $subject = 'Verify Your Email at StudyDigs';
            $message = 'Hi ' . $user->first_name . ', thank you for registering with StudyDigs, to verify your email please click <a href="' . URLROOT . 'users/verified/' . $user->vkey . '">here</a>';

            // set mail parameters
            $headers = 'From: no-reply@studydigs.com' . "\r\n" .
                'Reply-To: kiasambrook@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($to, $subject, $message, $headers);

            $this->view('users/verifyemail', $data);
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            session_destroy();

        else :
            redirect('dashboard');

        endif;
    }

    /**
     * Get the user's verification key and update the matching user to verified email = 1
     *
     * @param Int $vkey - The verification key of the user.
     * @return void
     */
    public function verified($vkey)
    {
        $data = [
            'vkey' => $vkey,
        ];

        $this->userModel->verifyUser($vkey);

        $this->view('users/verified', $data);
    }

    /**
     * Handles the login logic by ensuring that the user exists and the password is correct.
     *
     * @return void
     */
    public function login()
    {

        if (!userLoggedIn()) :
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form

                // Sanitise POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Innit data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                ];

                // Validate email
                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                }

                // Validate password
                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter password';
                }

                // Check for user/email in db
                if ($this->userModel->findUserByEmail($data['email'])) {
                    // user found
                } else {
                    // user not found
                    $data['email_err'] = 'No user found';
                }

                // Ensure there are no errors
                if (empty($data['email_err']) && empty($data['password_err'])) {
                    // Data is validated
                    // Check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if ($loggedInUser) {

                        if ($loggedInUser->company_id == NULL || $loggedInUser->company_id == 0) {
                            $this->createUserSession($loggedInUser, UNAUTHORISED);
                            flash('register_business', "To continue with login, please register a business to access your dashboard", "alert alert-warning");
                            redirect('users/registerbusiness');
                        } else if ($loggedInUser->verified == 0) {
                            $this->createUserSession($loggedInUser, UNAUTHORISED);
                            flash('register_business', "You have logged in successfully, please verify your email to continue",  "alert alert-warning");
                            redirect('users/verify');
                        } else {
                            // Create session variables
                            $this->createUserSession($loggedInUser, AUTHORISED);
                            redirect('dashboard');
                        }
                    } else {
                        $data['password_err'] = 'Password incorrect';

                        $this->view('users/login', $data);
                    }
                } else {
                    // Load the view with errors
                    $this->view('users/login', $data);
                }
            } else {
                // Innit data
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                ];

                // Load the view
                $this->view('users/login', $data);
            }

        else :
            redirect('dashboard');

        endif;
    }

    /**
     * Create a user session.
     *
     * @param object $user - The verified user.
     * @param string $type - The type of user (`admin`, `authorised`).
     * @return void
     */
    public function createUserSession($user, $type)
    {
        $_SESSION['user_type'] = $type;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->first_name;
        $_SESSION['user_email'] = $user->email;
    }

    /**
     * Destroy the user's session on logout.
     *
     * @return void
     */
    public function logout()
    {
        userLogout();
        redirect('users/login');
    }
}
