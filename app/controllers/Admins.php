<?php

/**
 * Admins is a class that extends the Controller class that controls the Admin related functions.
 *
 * The class will handle functions regarding  admin login, dashboard, and displaying data including
 * messages, users, properties, and companies.
 */
class Admins extends Controller
{
    /**
     * The __construct magic method is instantiate an Admin object.
     *
     * When called, user, company, property, admin, message, and university models are instantiated to
     * connect to the database.
     */
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
        $this->propertyModel = $this->model('Property');
        $this->adminModel = $this->model('Admin');
        $this->messageModel = $this->model('Message');
        $this->universityModel = $this->model('University');
    }

    /**
     * The index view.
     *
     * When a user arrives at the Admin URL, it will be checked whether the admin is already logged in
     * and if so what type of user they are.
     *
     * @return void
     */
    public function index()
    {
        if (userLoggedIn()) {
            /**
             * General authorised users will be logged out and redirected to admin login.
             */
            userLogout();
            redirect('admins/login');
        } elseif (isLoggedIn()) {
            /**
             * Authorised admins will be redirected to the dashboard.
             */
            redirect('admins/dashboard');
        } else {
            redirect('admins/login');
        }
    }

    /**
     * Handles the login page logic.
     *
     * When login form is submitted, the data is sanitised and checked for errors.
     * If there are no errors and the admin is found in the database, the user will be redirected to the dashboard.
     *
     * @return void
     */
    public function login()
    {
        /**
         * Check whether a POST request has been made.
         */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitise POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Innit data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => '',
            ];

            /**
             * Check whether admin exists.
             */
            if (!$this->adminModel->findUserByUsername($data['username'])) {
                // user not found
                $data['username_err'] = 'No user found';
            }

            // Validate password
            $data['password_err'] =  checkIfEmpty($data['password'], $data['password_err'], 'Password');
            // Validate username
            $data['username_err'] =  checkIfEmpty($data['username'], $data['username_err'], 'Username');

            /**
             * Check that there no error messages.
             */
            if (ensureNoErrors($data)) {
                // Check and set logged in user
                $loggedInUser = $this->adminModel->login($data['username'], $data['password']);

                /**
                 * If user exists, create session variables and redirect to dashboard.
                 */
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                    redirect('admins/dashboard');
                } else {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('admins/login', $data);
                }
            } else {
                // Load the view with errors
                $this->view('admins/login', $data);
            }
        } else {
            // If post request has not been made, load a blank view.
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => '',
            ];

            // Load the view
            $this->view('admins/login', $data);
        }
    }

    /**
     * Load the dashboard view.
     *
     * Display the admin dashboard with 3 most recent messages.
     *
     * @return void
     */
    public function dashboard()
    {
        // if general user is logged in
        if (userLoggedIn()) {
            redirect('dashboard');
        } elseif (isLoggedIn()) {
            // if admin is already signed in redirect to dashboard
            // Innit data
            $data = [
                'username' => $_SESSION['username'],
                'name' => $_SESSION['user_fname'],
                'messages' => '',
                'unreadMessages' => '',
            ];

            // get messages
            $data['messages'] = $this->messageModel->getLimitedMessages(3);
            $data['unreadMessages'] = $this->messageModel->unreadMessageCount()->unread;

            // Load the view
            $this->view('admins/dashboard', $data);
        } else {
            redirect('admins/login');
        }
    }

    /**
     * Load messages view.
     *
     * @return void
     */
    public function messages()
    {
        if (isLoggedIn()) :
            $data = [
                'messages' => '',
            ];

            // get messages
            $data['messages'] = $this->messageModel->getMessages();
            // Load the view
            $this->view('admins/messages', $data);
        endif;
    }

    /**
     * Load the message view of individual message.
     *
     * @param Int $id - The id of the message.
     * @return void
     */
    public function message($id)
    {
        if (isLoggedIn()) :
            $data = [
                'message' => '',
            ];

            $data['message'] = $this->messageModel->getMessage($id);

            if ($data['message'] != "") {
                $this->messageModel->updateReadStatus($id);

                // Load the view
                $this->view('admins/message', $data);
            } else {
                redirect('admins/messages');
            }
        endif;
    }

    /**
     * Delete selected message.
     *
     * @param Int $id - The message id to delete.
     * @return void
     */
    public function deleteMessage($id)
    {
        if (isLoggedIn()) :
            if ($this->messageModel->deleteMessage($id)) {
                flash('message_delete', 'Message deleted successfully!');
            } else {
                flash('message_delete', 'Message deletion failed', 'alert alert-danger');
            }
            redirect('admins');
        endif;
    }

    /**
     * Get all the properties and display the properties view.
     *
     * @return void
     */
    public function properties()
    {
        if (isLoggedIn()) :
            $data = [
                'properties' => '',
            ];

            // get properties
            $data['properties'] = $this->propertyModel->getProperties();

            // Load the view
            $this->view('admins/properties', $data);
        endif;
    }

    /**
     * Get all the users and display the users view.
     *
     * @return void
     */
    public function users()
    {
        if (isLoggedIn()) :
            $data = [
                'users' => '',
            ];

            // get properties
            $data['users'] = $this->userModel->getUsers();

            // Load the view
            $this->view('admins/users', $data);
        endif;
    }

    /**
     * Get all the companies and display the companies view.
     *
     * @return void
     */
    public function companies()
    {
        if (isLoggedIn()) :
            $data = [
                'companies' => '',
            ];

            // get properties
            $data['companies'] = $this->companyModel->getCompanies();

            // Load the view
            $this->view('admins/companies', $data);
        endif;
    }

    /**
     * Get all the universities and display the universities view.
     *
     * @return void
     */
    public function universities()
    {
        if (isLoggedIn()) :
            $data = [
                'universities' => '',
            ];

            // get properties
            $data['universities'] = $this->universityModel->getUniversitiesTable();

            // Load the view
            $this->view('admins/universities', $data);
        endif;
    }

    /**
     * Create a new university and store in the database.
     *
     * @return void
     */
    public function adduniversity()
    {
        if (isLoggedIn()) :
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitise POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // get the inputted data from form
                $data = [
                    'name' => trim(ucwords($_POST['name'])),
                    'name_err' => '',
                    'address1' => trim($_POST['address1']),
                    'address1_err' => '',
                    'address2' => trim($_POST['address2']),
                    'town' => trim($_POST['town']),
                    'town_err' => '',
                    'postcode' => trim($_POST['postcode']),
                    'postcode_err' => '',
                    'longitude' => '',
                    'latitude' => '',
                ];

                // error checking
                $data = $this->addUniversityErrorCheck($data);

                if (ensureNoErrors($data)) {
                    // convert postcode to longitude and latitude
                    $response = file_get_contents('https://api.postcodes.io/postcodes/' . $data['postcode']);
                    $response = json_decode($response, false);
                    $data['longitude'] = $response->result->longitude;
                    $data['latitude'] = $response->result->latitude;

                    $this->universityModel->insertUniversity($data);
                    // Load the view
                    redirect('admins/universities');

                    // create a message to confirm creation of university
                    flash('university_add', 'University added successfully!');
                } else {
                    $this->view('admins/adduniversity', $data);
                }
            } else {
                $data = [
                    'name' => '',
                    'name_err' => '',
                    'address1' => '',
                    'address1_err' => '',
                    'address2' => '',
                    'town' => '',
                    'town_err' => '',
                    'postcode' => '',
                    'postcode_err' => '',
                ];

                // Load the view
                $this->view('admins/adduniversity', $data);
            }
        endif;
    }

    /**
     * Error check the values submitted for adding a university.
     *
     * @param array $data - The data to error check
     * @return array $data - Return the data with error messages
     */
    private function addUniversityErrorCheck($data)
    {
        // Check university exists
        if (empty($data['name'])) {
            $data['name_err'] = 'University name cannot be empty';
        } elseif ($this->universityModel->findUniversityByName($data['name'])) {
            $data['name_err'] = 'University already exists, please try again';
        }
        $data['address1_err'] = checkIfEmpty($data['address1'], $data['address1_err'], 'Address');
        $data['town_err'] = checkIfEmpty($data['town'], $data['town_err'], 'Town');
        $data['postcode_err'] = checkIfEmpty($data['postcode'], $data['postcode_err'], 'Postcode');

        return $data;
    }

    /**
     * Delete selected university.
     *
     * @param Int $id - The id to delete
     * @return void
     */
    public function deleteUniversity($id)
    {
        if (isLoggedIn()) :
            if ($this->universityModel->deleteUniversity($id)) {
                flash('university_delete', 'University has been deleted successfully!');
            } else {
                flash('university_delete', 'University deletion failed', 'alert alert-danger');
            }
            redirect('admins/universities');
        endif;
    }

    /**
     * Delete selected property.
     *
     * @param Int $id - The id to delete
     * @return void
     */
    public function deleteProperty($id)
    {
        if (isLoggedIn()) :
            if ($this->propertyModel->deleteProperty($id)) {
                flash('property_delete', 'Property has been deleted successfully!');
            } else {
                flash('property_delete', 'Property deletion failed', 'alert alert-danger');
            }
            redirect('admins/properties');
        endif;
    }

    /**
     * Delete selected user.
     *
     * @param Int $id - The id to delete
     * @return void
     */
    public function deleteUser($id)
    {
        if (isLoggedIn()) :
            if ($this->userModel->deleteUser($id)) {
                flash('user_delete', 'User has been deleted successfully!');
            } else {
                flash('user_delete', 'User deletion failed', 'alert alert-danger');
            }
            redirect('admins/users');
        endif;
    }

    /**
     * Delete selected company.
     *
     * @param Int $id - The id to delete
     * @return void
     */
    public function deleteCompany($id)
    {
        if (isLoggedIn()) :
            if ($this->companyModel->deleteCompany($id)) {
                flash('company_delete', 'Company has been deleted successfully!');
            } else {
                flash('company_delete', 'Company deletion failed', 'alert alert-danger');
            }
            redirect('admins/companies');
        endif;
    }


    /**
     * End the admin session.
     *
     * @return void
     */
    public function logout()
    {
        adminLogout();
        redirect('admins');
    }

    /**
     * Begin an admin session.
     *
     * @param object $user - The user to create a session for.
     * @return void
     */
    public function createUserSession($user)
    {
        $_SESSION['user_type'] = ADMIN;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['user_fname'] = $user->first_name;
    }
}
