<?php

/**
 * Pages is a class that extends the Controller class that controls the main functions that the general users can access.
 *
 * The class will handle functions regarding the search, filtering, and displaing properties.
 */
class Pages extends Controller
{
    /**
     * The __construct magic method is instantiate a Pages object.
     *
     * When called company, property, message, and university models are instantiated to
     * connect to the database.
     */
    public function __construct()
    {
        // Get universities model
        $this->universityModel = $this->model('University');
        $this->messageModel = $this->model('Message');
        $this->propertyModel = $this->model('Property');
        $this->companyModel = $this->model('Company');
    }

    /**
     * The index view.
     *
     * When a user arrives at the URL, the honmepage is loaded and the list of universities is retrieved.
     *
     * @return void
     */
    public function index()
    {
        // Get universities by town
        $universities = $this->universityModel->getUniversities();

        // Pass university list to the view
        $data =  [
            'universities' => $universities,
            'name' => '',
            'email' => '',
            'subject' => '',
            'message' => '',
        ];
        $this->view('pages/index', $data);
    }

    /**
     * Retrieves the university id from the search results. If university does not exist, the user will be redirected to the homepage.
     *
     * @return void
     */
    public function search()
    {
        $search = [
            'id' => $_POST['uni'],
        ];
        if ($search['id'] != 'na') {
            redirect('pages/results/' . $search['id']);
        } else {
            redirect('');
        }
    }

    /**
     * Get all the properties near to the university. Also handles filtering of properties.
     *
     * @param string $id - The id of the university
     * @param string $sort - The sorting method
     * @return void
     */
    public function results($id = "", $sort = "distance")
    {
        $data = [
            'town' => $id,
            'sort' => $sort,
            'properties' => '',
            'university' => $this->universityModel->getUniversity($id),
            'filters' => array(
                'min_bedrooms' => '',
                'max_bedrooms' => '',
                'bathrooms' => '',
                'monthly_cost' => '',
                'bills_included' => '',
                'wifi' => '',
                'parking_space' => '',
                'dual_occupancy' => '',
                'pets' => '',
                'washing_machine' => '',
            ),
        ];

        // if property not selected go home
        if ($id == "" || $id == "na") {
            redirect('');
        } elseif ($id != "") {
            // get university coords
            $location = $this->universityModel->getCoords($id);
            // find properties that are nearby selected unviersity
            $data['properties'] = $this->propertyModel->getNearbyProperties($location->longitude, $location->latitude, $sort);
        }

        // filters have been applied
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // get filter variables
            $data['filters']['min_bedrooms'] = $_POST['min_bedrooms'] != "any" ? $_POST['min_bedrooms'] : 0;
            $data['filters']['max_bedrooms'] = $_POST['max_bedrooms'] != "any" ? $_POST['max_bedrooms'] : 0;
            $data['filters']['bathrooms'] = $_POST['bathrooms'] != "any" ? $_POST['bathrooms'] : 0;
            $data['filters']['monthly_cost'] = $_POST['rent'] != "any" ? $_POST['rent'] : 0;
            $data['filters']['bills_included'] = isset($_POST['bills']) ? 1 : 0;
            $data['filters']['wifi'] = isset($_POST['wifi']) ? 1 : 0;
            $data['filters']['parking_space'] = isset($_POST['parking']) ? 1 : 0;
            $data['filters']['dual_occupancy'] = isset($_POST['dual_occupancy']) ? 1 : 0;
            $data['filters']['pets'] = isset($_POST['pets']) ? 1 : 0;
            $data['filters']['washing_machine'] = isset($_POST['washing']) ? 1 : 0;

            $data['properties'] = filterProperties($data['properties'], $data['filters']);

            $this->view('pages/search', $data);
        }
        // load page without filters
        else {
            $this->view('pages/search', $data);
        }
    }

    /**
     * Handles the logic for the contact form. The message is inserted into the database.
     *
     * @return void
     */
    public function contact()
    {
        // check a post request has been made
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitise the data
            $_POST = filter_input_array(INPUT_POST);

            // Place the data into an array
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'message' => trim($_POST['message']),
                'name_err' => '',
                'email_err' => '',
                'subject_err' => '',
                'message_err' => '',
            ];


            // validate the processed data
            if (empty($data['name'])) {
                $data['name_err'] = 'Name cannot be empty';
            }
            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Email cannot be empty';
            }
            // Validate subject
            if (empty($data['subject'])) {
                $data['subject_err'] = 'Subject cannot be empty';
            }
            // Validate message
            if (empty($data['message'])) {
                $data['message_err'] = 'Message cannot be empty';
            }


            // Ensure no errors
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['subject_err']) && empty($data['messsage_err'])) {
                // no errors
                if ($this->messageModel->insertMessage($data)) {
                    flash('contact_message', 'Message sent successfully!');
                    redirect('pages/index');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('pages/index', $data);
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'subject' => '',
                'message' => '',
            ];

            $this->view('pages/index', $data);
        }
    }

    /**
     * Retrieves the selected property data from the database and passes it to the view.
     *
     * @param Int $id - The id of the selected property.
     * @return void
     */
    public function property($id)
    {
        if ($id == "" || $id <= 0) {
            redirect('');
        } else {
            $data = [
                'property' => '',
                'universities' => '',
                'walking' => '',
                'amenities' => '',
                'images' => '',
                'image_no' => 0,
                'floorplan' => '',
            ];

            // get property data
            $data['property'] = $this->propertyModel->getProperty($id);
            $data['amenities'] = $this->propertyModel->getAmenities($id);
            $data['images'] = $this->propertyModel->getHouseImages($id);
            $data['universities'] =  $this->universityModel->getCloseUniversities($data['property']->longitude, $data['property']->latitude);
            $data['floorplan'] = $this->propertyModel->getFloorplan($id);

            $this->view('pages/property', $data);
        }
    }

    /**
     * Retrieves the selected company's property data from the database and passes it to the view.
     *
     * @param Int $id - The id of the selected company.
     * @return void
     */
    public function company($id)
    {
        $company = $this->companyModel->getCompanyById($id);

        // get properties list
        $properties = $this->propertyModel->getCompanyPropertiesArray($company->id);

        $data = [
            'id' => $id,
            'company_name' => $company->name,
            'properties' => $properties,
            'filters' => array(
                'min_bedrooms' => '',
                'max_bedrooms' => '',
                'bathrooms' => '',
                'monthly_cost' => '',
                'bills_included' => '',
                'wifi' => '',
                'parking_space' => '',
                'dual_occupancy' => '',
                'pets' => '',
                'washing_machine' => '',
            ),
        ];

        // filters have been applied
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // get filter variables
            $data['filters']['min_bedrooms'] = $_POST['min_bedrooms'] != "any" ? $_POST['min_bedrooms'] : 0;
            $data['filters']['max_bedrooms'] = $_POST['max_bedrooms'] != "any" ? $_POST['max_bedrooms'] : 0;
            $data['filters']['bathrooms'] = $_POST['bathrooms'] != "any" ? $_POST['bathrooms'] : 0;
            $data['filters']['monthly_cost'] = $_POST['rent'] != "any" ? $_POST['rent'] : 0;
            $data['filters']['bills_included'] = isset($_POST['bills']) ? 1 : 0;
            $data['filters']['wifi'] = isset($_POST['wifi']) ? 1 : 0;
            $data['filters']['parking_space'] = isset($_POST['parking']) ? 1 : 0;
            $data['filters']['dual_occupancy'] = isset($_POST['dual_occupancy']) ? 1 : 0;
            $data['filters']['pets'] = isset($_POST['pets']) ? 1 : 0;
            $data['filters']['washing_machine'] = isset($_POST['washing']) ? 1 : 0;

            $data['properties'] = filterProperties($data['properties'], $data['filters']);
            $this->view('pages/portfolio', $data);
        } else {
            $this->view('pages/portfolio', $data);
        }
    }

    /**
     * Property reports are submitted to the database.
     *
     * @param Int $id - The id of the reported property
     * @return void
     */
    public function report($id)
    {
        // sanitise the data
        $_POST = filter_input_array(INPUT_POST);

        // Place the data into an array
        $data = [
            'name' => 'annoymous',
            'email' => 'annoymous',
            'subject' => 'Property ' .  $id . ' report: ' . $_POST['subject'],
            'message' => trim($_POST['message']),
        ];

        // no errors
        if ($this->messageModel->insertMessage($data)) {
            flash('contact_message', 'Report sent successfully!');
            redirect('pages/property/' . $id);
        }
    }
}
