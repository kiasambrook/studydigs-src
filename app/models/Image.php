<?php

/**
 * The data model for image related queries.
 */
class Image
{
    /**
     * On construction, create a database connection
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get all property images for selected property and image type.
     *
     * @param Int $propertyId - The id of the selected property
     * @param String $image_type - The type of image.
     * @return Array - The list of results.
     */
    public function getPhotoWithType($propertyId, $image_type)
    {
        $this->db->query('SELECT * FROM property_images WHERE property_id = :id && image_type = :image_type');
        // Bind value
        $this->db->bind(':id', $propertyId);
        $this->db->bind(':image_type', $image_type);

        $results = $this->db->resultSet();

        return $results;
    }
}
