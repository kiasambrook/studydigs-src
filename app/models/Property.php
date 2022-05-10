<?php

/**
 * The data model for property related queries.
 */
class Property
{
    /**
     * On construction, create a database connection
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get the selected company's properties.
     *
     * @param Int $id - the Id of the company
     * @return Array - Array of property objects
     */
    public function getCompanyProperties($id)
    {
        $this->db->query('SELECT `properties`.*, `properties`.`company_id`, `property_amenities`.*, `property_images`.*, `property_types`.*, `image_type`.*,
            properties.id as propertyId,
            property_amenities.id as amenitityId,
            property_types.id as typeId,
            image_type.id as imageTypeId,
            property_images.id as imageId,
            property_types.type as propertyType
            FROM `properties` 
                LEFT JOIN `property_amenities` ON `property_amenities`.`property_id` = `properties`.`id` 
                LEFT JOIN `property_images` ON `property_images`.`property_id` = `properties`.`id` 
                LEFT JOIN `property_types` ON `properties`.`property_type` = `property_types`.`id` 
                LEFT JOIN `image_type` ON `property_images`.`image_type` = `image_type`.`id`
            WHERE `properties`.`company_id` = :company_id
            AND property_images.image_type = 1');

        // Bind value
        $this->db->bind(':company_id', $id);

        $results = $this->db->resultSet();

        return $results;
    }

    /**
     * Get the selected company's properties.
     *
     * @param Int $id - the Id of the company
     * @return Array - Array of property
     */
    public function getCompanyPropertiesArray($id)
    {
        $this->db->query('SELECT `properties`.*, `properties`.`company_id`, `property_amenities`.*, `property_images`.*, `property_types`.*, `image_type`.*,
            properties.id as propertyId,
            property_amenities.id as amenitityId,
            property_types.id as typeId,
            image_type.id as imageTypeId,
            property_images.id as imageId,
            property_types.type as propertyType
            FROM `properties` 
                LEFT JOIN `property_amenities` ON `property_amenities`.`property_id` = `properties`.`id` 
                LEFT JOIN `property_images` ON `property_images`.`property_id` = `properties`.`id` 
                LEFT JOIN `property_types` ON `properties`.`property_type` = `property_types`.`id` 
                LEFT JOIN `image_type` ON `property_images`.`image_type` = `image_type`.`id`
            WHERE `properties`.`company_id` = :company_id
            AND property_images.image_type = 1');

        // Bind value
        $this->db->bind(':company_id', $id);

        $results = $this->db->resultSetArray();

        return $results;
    }

    /**
     * Get all of the property types.
     *
     * @return Array - Array of property types as objects
     */
    public function getPropertyTypes()
    {
        $this->db->query('SELECT * FROM property_types');
        return $this->db->resultSet();
    }

    /**
     * Get the ID of the property type.
     *
     * @param String $type - The type to search for.
     * @return Object - The property type object.
     */
    public function getPropertyTypeId($type)
    {
        $this->db->query('SELECT * FROM property_types
                            WHERE type = :ptype');

        $this->db->bind(':ptype', $type);

        return $this->db->single();
    }

    /**
     * Get the image type from a image.
     *
     * @param String $Image - The type to search for.
     * @return Object - The image type object.
     */
    public function getImageType($image)
    {
        $this->db->query('SELECT * FROM image_type WHERE type = :type');

        $this->db->bind(':type', $image);

        return $this->db->single();
    }

    /**
     * Get image using file path.
     *
     * @param String $path - The file path of the image.
     * @return Object - The image object.
     */
    public function getImage($path)
    {
        $this->db->query('SELECT * FROM property_images WHERE file_location = :path');

        $this->db->bind(':path', $path);

        return $this->db->single();
    }

    /**
     * Get all the house images.
     *
     * @param Int $id - Id of the property.
     * @return Array - Array of house images as objects
     */
    public function getHouseImages($id)
    {
        $this->db->query('SELECT * FROM property_images WHERE image_type = 2 AND property_id = :id');

        $this->db->bind(':id', $id);

        return $this->db->resultSet();
    }

    /**
     * Insert the property details into the properties table.
     *
     * @param Array $data - Array of the data to insert
     * @return void
     */
    public function insertPropertyDetails($data)
    {
        $this->db->query('INSERT INTO properties(company_id,flat_number,building_number,address1,address2,town,postcode,property_type,on_market,availability_date,min_contract_length,max_contract_length,deposit,monthly_cost, tenancy_info, longitude, latitude)VALUES(:company_id,:flat_number,:building_number,:address1,:address2,:town,:postcode,:property_type,:on_market,:availability_date,:min_contract_length,:max_contract_length,:deposit,:monthly_cost, :tenancy_info, :longitude, :latitude)');

        // Bind values
        $this->db->bind(':company_id', $data['company_id']);
        $this->db->bind(':flat_number', $data['flat_number']);
        $this->db->bind(':building_number', $data['house_number']);
        $this->db->bind(':address1', $data['street']);
        $this->db->bind(':address2', $data['address2']);
        $this->db->bind(':town', $data['town']);
        $this->db->bind(':postcode', $data['postcode']);
        $this->db->bind(':property_type', $data['property_type']);
        $this->db->bind(':on_market', $data['market']);
        $this->db->bind(':availability_date', $data['availability']);
        $this->db->bind(':min_contract_length', $data['min_contract_length']);
        $this->db->bind(':max_contract_length', $data['max_contract_length']);
        $this->db->bind(':deposit', $data['deposit']);
        $this->db->bind(':monthly_cost', $data['monthly_rent']);
        $this->db->bind(':longitude', $data['longitude']);
        $this->db->bind(':latitude', $data['latitude']);
        $this->db->bind(':tenancy_info', $data['tenancy']);

        $this->db->execute();
    }

    /**
     * Insert the property amenities into the property amenities table.
     *
     * @param Array $data - Array of the data to insert
     * @return void
     */
    public function insertAmenities($data, $property)
    {
        $this->db->query('INSERT INTO property_amenities(property_id, bedrooms, bathrooms, ensuite, double_bed,parking_space, garden, washing_machine, wifi, pets, dual_occupancy,lockable_bedrooms,bills_included) VALUES(:property_id, :bedrooms, :bathrooms, :ensuite, :double_beds, :parking_space, :garden, :washing_machine, :wifi, :pets, :dual_occupancy, :lockable_bedrooms, :bills_included)');

        // Bind values
        $this->db->bind(':property_id', $property);
        $this->db->bind(':bedrooms', $data['bedrooms']);
        $this->db->bind(':bathrooms', $data['bathrooms']);
        $this->db->bind(':ensuite', $data['ensuites']);
        $this->db->bind(':double_beds', $data['double_beds']);
        $this->db->bind(':parking_space', $data['parking_space']);
        $this->db->bind(':garden', $data['garden']);
        $this->db->bind(':washing_machine', $data['washing_machine']);
        $this->db->bind(':wifi', $data['wifi']);
        $this->db->bind(':pets', $data['pets']);
        $this->db->bind(':dual_occupancy', $data['dual_occupancy']);
        $this->db->bind(':lockable_bedrooms', $data['lockable_bedrooms']);
        $this->db->bind(':bills_included', $data['bills_included']);

        $this->db->execute();
    }

    /**
     * Insert images into the property images table
     *
     * @param String $path - The path of the image
     * @param Int $property- id of the property
     * @param Int $type - Id of the image type
     * @return void
     */
    public function insertImages($path, $property, $type)
    {
        $this->db->query('INSERT INTO property_images(property_id,file_location,image_type)VALUES(:property_id,:path,:type)');

        // Bind values
        $this->db->bind(':property_id', $property);
        $this->db->bind(':path', $path);
        $this->db->bind(':type', $type);


        $this->db->execute();
    }

    /**
     * Insert the property transaction
     *
     * @param Array $data - The array of data to insert
     * @return void
     */
    public function insertProperty($data)
    {
        $this->db->beginTransaction();

        // insert general property information and retreive property ID
        $this->insertPropertyDetails($data);
        $property = $this->db->getLastId();
        $this->insertAmenities($data, $property);

        // get the image types
        $feature = $this->getImageType("feature")->id;
        $floorplan = $this->getImageType("floorplan")->id;
        $house = $this->getImageType("house")->id;

        // insert the images if they are not empty
        if (!empty($data['feature_image'])) {
            $this->insertImages($data['feature_image'], $property, $feature);
        }
        if (!empty($data['floorplan_image'])) {
            $this->insertImages($data['floorplan_image'], $property, $floorplan);
        }

        $totalHouseImages = count($data['house_images']['name']);
        for ($i = 0; $i < $totalHouseImages; $i++) {
            if ($data['house_images' . $i]['name'] != "") {
                $this->insertImages($data['house_images' . $i], $property, $house);
            }
        }

        $this->db->commitTransaction();
    }

    /**
     * Get all properties along with their amenities, images, types, and companies.
     *
     * @return ObjectArray - List of properties
     */
    public function getProperties()
    {
        $this->db->query('SELECT
            `properties`.*,
            `property_amenities`.*,
            `property_images`.*,
            `property_types`.*,
            `image_type`.*,
            companies.*,
            properties.id AS propertyId,
            property_amenities.id AS amenitityId,
            property_types.id AS typeId,
            image_type.id AS imageTypeId,
            property_images.id AS imageId,
            property_types.type AS propertyType,
            companies.id AS companyId,
            companies.address1 AS companyAddress1,
            companies.address2 AS companyAddress2,
            companies.town AS companyTown,
            companies.postcode AS companyPostcode,
            properties.address1 AS propertyAddress1,
            properties.address2 AS propertyAddress2,
            properties.town AS propertyTown,
            properties.postcode AS propertyPostcode
        FROM
            `properties`
        LEFT JOIN `property_amenities` ON `property_amenities`.`property_id` = `properties`.`id`
        LEFT JOIN `property_images` ON `property_images`.`property_id` = `properties`.`id`
        LEFT JOIN `property_types` ON `properties`.`property_type` = `property_types`.`id`
        LEFT JOIN `image_type` ON `property_images`.`image_type` = `image_type`.`id`
        LEFT JOIN companies ON companies.id = properties.company_id');

        return  $this->db->resultSetArray();
    }

    /**
     * Get select property.
     *
     * @param Int $id - Id of property
     * @return Object - Property object
     */
    public function getProperty($id)
    {
        $this->db->query('SELECT
            `properties`.*,
            `property_amenities`.*,
            `property_images`.*,
            `property_types`.*,
            `image_type`.*,
            companies.*,
            properties.id AS propertyId,
            property_amenities.id AS amenitityId,
            property_types.id AS typeId,
            image_type.id AS imageTypeId,
            property_images.id AS imageId,
            property_types.type AS propertyType,
            companies.id AS companyId,
            companies.address1 AS companyAddress1,
            companies.address2 AS companyAddress2,
            companies.town AS companyTown,
            companies.postcode AS companyPostcode,
            properties.address1 AS propertyAddress1,
            properties.address2 AS propertyAddress2,
            properties.town AS propertyTown,
            properties.postcode AS propertyPostcode
        FROM
            `properties`
        LEFT JOIN `property_amenities` ON `property_amenities`.`property_id` = `properties`.`id`
        LEFT JOIN `property_images` ON `property_images`.`property_id` = `properties`.`id`
        LEFT JOIN `property_types` ON `properties`.`property_type` = `property_types`.`id`
        LEFT JOIN `image_type` ON `property_images`.`image_type` = `image_type`.`id`
        LEFT JOIN companies ON companies.id = properties.company_id
        WHERE
            `properties`.`id` = :id');

        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Get amentities for a select property.
     *
     * @param Int $id - Id of property
     * @return Object - Property amenity
     */
    public function getAmenities($id)
    {
        $this->db->query('SELECT ensuite, double_bed, parking_space, garden, washing_machine,wifi,pets,dual_occupancy, lockable_bedrooms, bills_included
        FROM property_amenities WHERE property_id = :id');

        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Delete select property.
     *
     * @param Int $id - Id of property to delete
     * @return Boolean - True if executed, false if not.
     */
    public function deleteProperty($id)
    {
        $this->db->query('DELETE FROM properties
                            WHERE id = :id');

        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get properties near to the provided longitude and latitude.
     *
     * @param Int $long - Longitude of the university.
     * @param Int $lat - Latitude of the university.
     * @return ObjectArray - List of nearby properties.
     */
    public function getNearbyProperties($long, $lat)
    {
        $this->db->query("SELECT `properties`.*, `property_amenities`.*, `property_images`.*, `property_types`.*, `image_type`.*,
            properties.id as propertyId,
            property_amenities.id as amenitityId,
            property_types.id as typeId,
            image_type.id as imageTypeId,
            property_images.id as imageId,
            property_types.type as propertyType,
            ((ACOS(SIN(:lat * PI() / 180) * SIN(latitude * PI() / 180) + COS(:lat * PI() / 180) * COS(latitude * PI() / 180) * COS((:long - longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` FROM `properties`
                LEFT JOIN `property_amenities` ON `property_amenities`.`property_id` = `properties`.`id` 
                LEFT JOIN `property_images` ON `property_images`.`property_id` = `properties`.`id` 
                LEFT JOIN `property_types` ON `properties`.`property_type` = `property_types`.`id` 
                LEFT JOIN `image_type` ON `property_images`.`image_type` = `image_type`.`id`
            WHERE property_images.image_type = 1
            HAVING `distance`<10 ORDER BY `distance` ASC");

        $this->db->bind(":long", $long);
        $this->db->bind(":lat", $lat);

        return $this->db->resultSetArray();
    }

    /**
     * Get the property floorplan.
     *
     * @param Int $id - id of the property.
     * @return Object - Image object of floorplan
     */
    public function getFloorplan($id)
    {
        $this->db->query('SELECT * FROM property_images WHERE image_type = 3 AND property_id = :id');

        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    /**
     * Update the select property data.
     *
     * @param Int $id - Id of the property.
     * @param Array $data - The data to update the property with.
     * @return void
     */
    public function updateProperty($id, $data)
    {
        $this->db->query('UPDATE properties
                        SET flat_number = :flat_number,
                        building_number = :building_number,
                        address1 = :address1,
                        address2 = :address2,
                        town = :town,
                        postcode = :postcode,
                        property_type = :property_type,
                        on_market = :on_market, 
                        availability_date = :availability_date,
                        min_contract_length = :min_contract_length,
                        max_contract_length = :max_contract_length,
                        deposit = :deposit,
                        monthly_cost = :monthly_cost,
                        longitude = :longitude,
                        latitude = :latitude
                        WHERE id = :id');


        // Bind values
        $this->db->bind(':id', $id);
        $this->db->bind(':flat_number', $data['updated_property']['flat_number']);
        $this->db->bind(':building_number', $data['updated_property']['building_number']);
        $this->db->bind(':address1', $data['updated_property']['address1']);
        $this->db->bind(':address2', $data['updated_property']['address2']);
        $this->db->bind(':town', $data['updated_property']['town']);
        $this->db->bind(':postcode', $data['updated_property']['postcode']);
        $this->db->bind(':property_type', $data['updated_property']['property_type']);
        $this->db->bind(':on_market', $data['updated_property']['on_market']);
        $this->db->bind(':availability_date', $data['updated_property']['availability_date']);
        $this->db->bind(':min_contract_length', $data['updated_property']['min_contract_length']);
        $this->db->bind(':max_contract_length', $data['updated_property']['max_contract_length']);
        $this->db->bind(':deposit', $data['updated_property']['deposit']);
        $this->db->bind(':monthly_cost', $data['updated_property']['monthly_cost']);
        $this->db->bind(':longitude', $data['updated_property']['longitude']);
        $this->db->bind(':latitude', $data['updated_property']['latitude']);

        $this->db->execute();
    }

    /**
     * Update the select property amentity data.
     *
     * @param Int $id - Id of the property.
     * @param Array $data - The data to update the amenities with.
     * @return void
     */
    public function updateAmenities($id, $data)
    {
        $this->db->query('UPDATE property_amenities
                        SET bedrooms = :bedrooms, 
                        bathrooms = :bathrooms, 
                        ensuite = :ensuite, 
                        double_bed = :double_bed,
                        parking_space = :parking_space, 
                        garden =:garden, 
                        washing_machine = :washing_machine, 
                        wifi = :wifi, 
                        pets = :pets, 
                        dual_occupancy = :dual_occupancy,
                        lockable_bedrooms = :lockable_bedrooms,
                        bills_included = :bills_included
                        WHERE property_id = :property_id');

        // Bind values
        $this->db->bind(':property_id', $id);
        $this->db->bind(':bedrooms', $data['updated_property']['bedrooms']);
        $this->db->bind(':bathrooms', $data['updated_property']['bathrooms']);
        $this->db->bind(':ensuite', $data['updated_property']['ensuite']);
        $this->db->bind(':double_bed', $data['updated_property']['double_bed']);
        $this->db->bind(':parking_space', $data['updated_property']['parking_space']);
        $this->db->bind(':garden', $data['updated_property']['garden']);
        $this->db->bind(':washing_machine', $data['updated_property']['washing_machine']);
        $this->db->bind(':wifi', $data['updated_property']['wifi']);
        $this->db->bind(':pets', $data['updated_property']['pets']);
        $this->db->bind(':dual_occupancy', $data['updated_property']['dual_occupancy']);
        $this->db->bind(':lockable_bedrooms', $data['updated_property']['lockable_bedrooms']);
        $this->db->bind(':bills_included', $data['updated_property']['bills_included']);

        $this->db->execute();
    }

    /**
     * Transaction to update the property.
     *
     * @param Int $id - Id of the property.
     * @param Array $data - The data to update the property with.
     * @return void
     */
    public function updatePropertyTransaction($id, $data)
    {
        $this->db->beginTransaction();
        $this->updateProperty($id, $data);
        $this->updateAmenities($id, $data);
        $this->db->commitTransaction();
    }
}
