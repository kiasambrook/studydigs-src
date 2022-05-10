<?php

/**
 * Dashboard is a class that extends the Controller class that controls the Authorised User related functions.
 *
 * The class will handle functions regarding the portfolio, managing account options, and managing properties.
 */
class Dashboard extends Controller
{
    /**
     * The __construct magic method is instantiate a Dashboard object.
     *
     * When called, user, company, and property models are instantiated to connect to the database. 
     * Also checks whether the user is logged in.
     */
    public function __construct()
    {
        // check if user is logged in
        if (!userLoggedIn()) {
            redirect('users/login');
        }

        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
        $this->propertyModel = $this->model('Property');
        $this->imageModel = $this->model('Image');
    }

    /**
     * The index view.
     *
     * When a user arrives at the Dashboard URL, it will be checked whether the company and its properties' data are retrieved from the database 
     *
     * @return void
     */
    public function index()
    {
        // get user info
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $company = $this->companyModel->getCompanyById($user->company_id);

        // get properties list
        $properties = $this->propertyModel->getCompanyProperties($company->id);

        $data = [
            'name' => $_SESSION['user_name'],
            'company_name' => $company->name,
            'properties' => $properties,
        ];

        $this->view('dashboard/index', $data);
    }

    /**
     * Display the add property and insert the data into the database on POST request.
     *
     * @return void
     */
    public function addproperty()
    {
        // retreive types of property from database
        $propertyTypes = $this->propertyModel->getPropertyTypes();
        $user = $this->userModel->getUserById($_SESSION['user_id']);

        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitise POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'company_id' => $this->companyModel->getCompanyById($user->company_id)->id,
                'name' => $_SESSION['user_name'],
                'property_types' => $propertyTypes,
                'property_type' => '',
                'property_type_err' => '',
                'house_number' => trim($_POST['house_number']),
                'house_number_err' => '',
                'flat_number' => trim($_POST['flat_number']),
                'street' => trim($_POST['street']),
                'street_err' => '',
                'address2' => trim($_POST['address2']),
                'town' => trim($_POST['town']),
                'town_err' => '',
                'postcode' => trim($_POST['postcode']),
                'postcode_err' => '',
                'availability' => $_POST['availability'],
                'availability_err' => '',
                'min_contract_length' => trim($_POST['min_contract_length']),
                'min_contract_length_err' => '',
                'max_contract_length' => trim($_POST['max_contract_length']),
                'max_contract_length_err' => '',
                'deposit' => trim($_POST['deposit']),
                'deposit_err' => '',
                'monthly_rent' => trim($_POST['monthly_rent']),
                'monthly_rent_err' => '',
                'market' => trim($_POST['market']),
                'tenancy' => trim($_POST['tenancy']),
                'bedrooms' => trim($_POST['bedrooms']),
                'bedrooms_err' => '',
                'bathrooms' => trim($_POST['bathrooms']),
                'bathrooms_err' => '',
                'ensuites' => trim($_POST['ensuites']),
                'ensuites_err' => '',
                'double_beds' => trim($_POST['double_beds']),
                'double_beds_err' => '',
                'parking_space' => trim($_POST['parking_space']),
                'parking_space_err' => '',
                'garden' => trim($_POST['garden']),
                'washing_machine' => trim($_POST['washing_machine']),
                'wifi' => trim($_POST['wifi']),
                'pets' => trim($_POST['pets']),
                'dual_occupancy' => trim($_POST['dual_occupancy']),
                'lockable_bedrooms' => trim($_POST['lockable_bedrooms']),
                'bills_included' => trim($_POST['bills_included']),
                'feature_image' => $_FILES['feature_image'],
                'feature_image_err' => '',
                'floorplan_image' => $_FILES['floorplan_image'],
                'floorplan_image_err' => '',
                'house_images' => $_FILES['house_images'],
                'house_images_err' => '',
                'longitude' => '',
                'latitude' => '',
            ];

            // error checking
            $data = $this->addPropertyErrorCheck($data);
            if (ensureNoErrors($data)) {
                // move images
                $data['feature_image'] = moveFiles('feature_image', 'properties/feature');
                $data['floorplan_image'] = moveFiles('floorplan_image', 'properties/floorplan');
                $total = count($data['house_images']['name']);
                for ($i = 0; $i < $total; $i++) {
                    //Get the temp file path
                    $tmpFilePath = $data['house_images']['tmp_name'][$i];

                    //Make sure we have a file path
                    if ($tmpFilePath != "") {
                        $ext = pathinfo($data['house_images']["name"][$i], PATHINFO_EXTENSION);
                        $file_name = md5($data['house_images']["name"][$i]) . '.' . $ext;
                        //Setup our new file path
                        $newFilePath = dirname(APPROOT) . "/public/img/properties/house/" . $file_name;
                        $storedPath = "public/img/properties/house/" . $file_name;

                        //Upload the file into the temp dir
                        move_uploaded_file($tmpFilePath, $newFilePath);
                        $data += array('house_images' . $i => $storedPath);
                    }
                }

                foreach ($data as $key => $val) {
                    if (empty($val)) {
                        $data[$key] = 0;
                    }
                }


                // convert postcode into long and lat
                $postcode = str_replace(" ", "", $data['postcode']);
                $response = @file_get_contents('https://api.postcodes.io/postcodes/' . $postcode);
                $response = json_decode($response, false);
                if ($response == FALSE) {
                    $data['postcode_err'] = 'Postcode not found, please try again';
                } else if ($response == TRUE) {
                    $data['longitude'] = $response->result->longitude;
                    $data['latitude'] = $response->result->latitude;
                    // format postcode
                    $postcode = substr_replace($data['postcode'], ' ' . substr($data['postcode'], -3), -3);
                    $data['postcode'] = strtoupper($postcode);

                    // get property_type id
                    $type = $this->propertyModel->getPropertyTypeId($data['property_type']);
                    $data['property_type'] = $type->id;
                    // Insert into database
                    $this->propertyModel->insertProperty($data);



                    redirect('dashboard');
                }
            }


            $this->view('dashboard/addproperty', $data);
        } else {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'property_types' => $propertyTypes,
                'house_number' => '',
                'flat_number' => '',
                'street' => '',
                'address2' => '',
                'town' => '',
                'postcode' => '',
                'min_contract_length' => '',
                'max_contract_length' => '',
                'deposit' => '',
                'deposit_err' => '',
                'monthly_rent' => '',
                'monthly_rent_err' => '',
                'market' => '',
                'bedrooms' => '',
                'bedrooms_err' => '',
                'bathrooms' => '',
                'bathrooms_err' => '',
                'ensuites' => '',
                'double_beds' => '',
                'parking_space' => '',
                'garden' => '',
                'washing_machine' => '',
                'wifi' => '',
                'pets' => '',
                'dual_occupancy' => '',
                'lockable_bedrooms' => '',
                'bills_included' => '',
                'feature_image' => '',
                'floorplan_image' => '',
                'house_images' => '',
            ];

            $this->view('dashboard/addproperty', $data);
        }
    }

    /**
     * Check the submitted property data for errors.
     *
     * @param array $data - The array data is error check.
     * @return array $data - The data array that is returned with the errors. 
     */
    public function addPropertyErrorCheck($data)
    {
        if (!isset($_POST['property_type'])) {
            $data['property_type_err'] = 'Property type cannot be empty';
        } else {
            $data['property_type'] = trim($_POST['property_type']);
        }

        // check postcode length
        if (strlen($data['postcode']) > 8) {
            $data['postcode_err'] = 'Postcode cannot be more than 8 characters';
        } elseif (strlen($data['postcode']) < 6) {
            $data['postcode_err'] = 'Postcode cannot be less than 6 characters';
        }

        !isPostcodeValid($data['postcode']) ? $data['postcode_err'] = '' : $data['postcode_err'] = 'Postcode must be in standard UK format';

        // check if data is not less than zero
        $data['deposit_err'] = checkIfBelowZero($data['deposit'], $data['deposit_err'], 'Deposit');
        $data['monthly_rent_err'] = checkIfBelowZero($data['monthly_rent'], $data['monthly_rent_err'], 'Monthly rent');
        $data['min_contract_length_err'] = checkIfBelowZero($data['min_contract_length'], $data['min_contract_length_err'], 'Minimum contract length');
        $data['max_contract_length_err'] = checkIfBelowZero($data['max_contract_length'], $data['max_contract_length_err'], 'Maximum contract length');
        $data['bedrooms_err'] = checkIfBelowZero($data['bedrooms'], $data['bedrooms_err'], 'Bedrooms');
        $data['bathrooms_err'] = checkIfBelowZero($data['bathrooms'], $data['bathrooms_err'], 'Bathrooms');
        $data['ensuites_err'] = checkIfBelowZero($data['ensuites'], $data['ensuites_err'], 'Ensuites');
        $data['double_beds_err'] = checkIfBelowZero($data['double_beds'], $data['double_beds_err'], 'Double beds');
        $data['parking_space_err'] = checkIfBelowZero($data['parking_space'], $data['parking_space_err'], 'Parking Spaces');

        // check if data is empty
        $data['house_number_err'] =     checkIfEmpty($data['house_number'], $data['house_number_err'], 'House number');
        $data['street_err'] = checkIfEmpty($data['street'], $data['street_err'], 'Street');
        $data['town_err'] = checkIfEmpty($data['town'], $data['town_err'], 'Town');
        $data['postcode_err'] = checkIfEmpty($data['postcode'], $data['postcode_err'], 'Postcode');
        $data['availability_err'] = checkIfEmpty($data['availability'], $data['availability_err'], 'Availability');
        $data['monthly_rent_err'] = checkIfEmpty($data['monthly_rent'], $data['monthly_rent_err'], 'Monthly rent');
        $data['bedrooms_err'] = checkIfEmpty($data['bedrooms'], $data['bedrooms_err'], 'Bedrooms');
        $data['bathrooms_err'] = checkIfEmpty($data['bathrooms'], $data['bathrooms_err'], 'Bathrooms');

        // check images for size and extension
        $data['feature_image_err'] = imageExtensionCheck($data['feature_image']['name'], $data['feature_image_err']);
        $data['floorplan_image_err'] = imageExtensionCheck($data['floorplan_image']['name'], $data['floorplan_image_err']);
        $data['floorplan_image_err'] = imageFileSize('floorplan_image');
        $data['feature_image_err'] = imageFileSize('feature_image');

        $total = count($data['house_images']['name']);
        for ($i = 0; $i < $total; $i++) {
            $data['house_images_err'] = imageExtensionCheck($data['house_images']['name'][$i], $data['house_images_err']);
        }

        return $data;
    }

    /**
     * Delete the selected property.
     *
     * @param Int $id - The id of the property to delete.
     * @return void
     */
    public function delete($id)
    {
        if ($this->propertyModel->deleteProperty($id)) {
            flash('property_delete', 'Property has been deleted successfully!');
        } else {
            flash('property_delete', 'Property deletion failed', 'alert alert-danger');
        }
        redirect('dashboard');
    }

    /**
     * Load the edit property form.
     *
     * @param int $id - the id of the property.
     * @return void
     */
    public function edit($id)
    {
        if (!empty($id)) :
            $data = [
                'id' => $id,
                'property' => $this->propertyModel->getProperty($id),
                'property_types' => $this->propertyModel->getPropertyTypes(),
            ];

            $this->view('dashboard/editproperty', $data);


        else :
            redirect('dashboard');

        endif;
    }

    /**
     * Update the property data.
     *
     * @param Int $id - The id of the property to update.
     * @return void
     */
    public function editProperty($id)
    {
        $data = [
            'property' => $this->propertyModel->getProperty($id),
            'updated_property' => array(
                'property_type' => $_POST['property_type'],
                'building_number' => trim($_POST['house_number']),
                'flat_number' => trim($_POST['flat_number']),
                'address1' => trim($_POST['street']),
                'address2' => trim($_POST['address2']),
                'town' => trim($_POST['town']),
                'postcode' => trim($_POST['postcode']),
                'availability_date' => $_POST['availability'],
                'min_contract_length' => trim($_POST['min_contract_length']),
                'max_contract_length' => trim($_POST['max_contract_length']),
                'deposit' => trim($_POST['deposit']),
                'monthly_cost' => trim($_POST['monthly_rent']),
                'on_market' => trim($_POST['market']),
                'bedrooms' => trim($_POST['bedrooms']),
                'bathrooms' => trim($_POST['bathrooms']),
                'ensuite' => trim($_POST['ensuites']),
                'double_bed' => trim($_POST['double_beds']),
                'parking_space' => trim($_POST['parking_space']),
                'garden' => trim($_POST['garden']),
                'washing_machine' => trim($_POST['washing_machine']),
                'wifi' => trim($_POST['wifi']),
                'pets' => trim($_POST['pets']),
                'dual_occupancy' => trim($_POST['dual_occupancy']),
                'lockable_bedrooms' => trim($_POST['lockable_bedrooms']),
                'bills_included' => trim($_POST['bills_included']),
                'longitude' => '',
                'latitude' => '',
            )
        ];

        // loop through and if any are empty, use orginal value
        foreach ($data['updated_property'] as $attribute => $val) {
            if (empty($val)) {
                $data['updated_property'][$attribute] = $data['property']->$attribute;
            }
        }

        // get property_type id
        $type = $this->propertyModel->getPropertyTypeId($data['updated_property']['property_type']);
        $data['updated_property']['property_type'] = $type->id;

        // convert postcode into long and lat
        $postcode = str_replace(" ", "", $data['updated_property']['postcode']);
        $response = file_get_contents('https://api.postcodes.io/postcodes/' . $postcode);
        $response = json_decode($response, false);
        $data['updated_property']['longitude'] = $response->result->longitude;
        $data['updated_property']['latitude'] = $response->result->latitude;

        // format postcode
        $postcode = substr_replace($data['updated_property']['postcode'], ' ' . substr($data['updated_property']['postcode'], -3), -3);
        $data['updated_property']['postcode'] = strtoupper($postcode);

        $this->propertyModel->updatePropertyTransaction($id, $data);

        redirect('dashboard');
    }

    /**
     * Update the user's account in the database.
     *
     * @return void
     */
    public function editAccount()
    {
        $data =
            [
                'usersId' => $_SESSION['user_id'],
                'user' => $this->userModel->getUserById($_SESSION['user_id']),
                'company' => '',
                'updated_user' => array(
                    'email' => '',
                    'first_name' => '',
                    'last_name' => '',
                    'id' => '',
                ),
                'updated_company' => array(
                    'id' => '',
                    'name' => '',
                    'address1' => '',
                    'address2' => '',
                    'town' => '',
                    'postcode' => '',
                    'email' => '',
                    'telephone' => '',
                )

            ];

        // get company data
        $data['company'] = $this->companyModel->getCompanyById($data['user']->company_id);

        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // get data
            $data['updated_user']['email'] = $_POST['email'];
            $data['updated_user']['first_name'] = $_POST['first_name'];
            $data['updated_user']['last_name'] = $_POST['last_name'];
            $data['updated_company']['name'] = $_POST['company_name'];
            $data['updated_company']['address1'] = $_POST['address1'];
            $data['updated_company']['address2'] = $_POST['address2'];
            $data['updated_company']['town'] = $_POST['town'];
            $data['updated_company']['postcode'] = $_POST['postcode'];
            $data['updated_company']['email'] = $_POST['company_email'];
            $data['updated_company']['telephone'] = $_POST['telephone'];


            // loop through and if any are empty, use orginal value
            foreach ($data['updated_user'] as $attribute => $val) {
                if (empty($val)) {
                    $data['updated_user'][$attribute] = $data['user']->$attribute;
                }
            }
            // loop through and if any are empty, use orginal value
            foreach ($data['updated_company'] as $attribute => $val) {
                if (empty($val)) {
                    $data['updated_company'][$attribute] = $data['company']->$attribute;
                }
            }

            // format postcode
            $postcode = substr_replace($data['updated_company']['postcode'], ' ' . substr($data['updated_company']['postcode'], -3), -3);
            $data['updated_company']['postcode'] = strtoupper($postcode);

            if ($this->userModel->updateUser($data['updated_user']) && $this->companyModel->updateCompany($data['updated_company'])) {
                flash('edit_account', 'Account has been updated successfully!');
            } else {
                flash('edit_account', 'Uh-oh! Something went wrong.', 'alert alert-danger');
            }

            redirect('dashboard');
        } else {
            $this->view('dashboard/editaccount', $data);
        }
    }
}
