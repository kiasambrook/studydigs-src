<?php
/**
 * The data model for property related queries.
 */
class University
{
    private $db;

    /**
     * On construction, create a database connection
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get all universities.
     *
     * @return Array - Array of universities objects
     */
    public function getUniversities()
    {
        $this->db->query("SELECT *
                            FROM universities
                            ORDER BY name ASC");

        $results = $this->db->resultSet();

        return $results;
    }

    /**
     * Get all universities as a array items.
     *
     * @return Array - Array of universities array,
     */
    public function getUniversitiesTable()
    {
        $this->db->query("SELECT *
                                    FROM universities");

        $results = $this->db->resultSetArray();

        return $results;
    }

    /**
     * Get selected university.
     *
     * @param Int $id - Id of the selected university.
     * @return Object - Object of a university.
     */
    public function getUniversity($id)
    {
        $this->db->query("SELECT * FROM universities 
                            WHERE id = :id");

        $this->db->bind(":id", $id);
        return $this->db->single();
    }

    /**
     * Get longitude and latitude coordinates of the university.
     *
     * @param Int $id - The id of the university to search.
     * @return Object - Object of a university.
     */
    public function getCoords($id){
        $this->db->query("SELECT longitude, latitude FROM universities WHERE id= :id");

        $this->db->bind(":id", $id);

        return $this->db->single();
    }

    /**
     * Retrieve the closest universities to a provided longitude and latitude coordinates.
     *
     * @param Int $long - Provided longitude values.
     * @param Int $lat - Provided latitude values.
     * @return Array - Array of universities array,
     */
    public function getCloseUniversities($long, $lat){
        $this->db->query("SELECT *, ((ACOS(SIN(:lat * PI() / 180) * SIN(latitude * PI() / 180) + COS(:lat * PI() / 180) * COS(latitude * PI() / 180) * COS((:long - longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` FROM `universities` HAVING `distance`<10 ORDER BY `distance` ASC LIMIT 4 ");

        $this->db->bind(":long", $long);
        $this->db->bind(":lat", $lat);

        return $this->db->resultSetArray();
    }

    /**
     * Find a university using its name.
     *
     * @param String $university - The name of the university.
     * @return Bool - True if found, false if not.
     */
    public function findUniversityByName($university)
    {
        $this->db->query("SELECT * FROM universities 
                            WHERE name = :name");

        $this->db->bind(":name", $university);

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Insert a university into the university table.
     *
     * @param Array $data - The array of data to insert.
     * @return void
     */
    public function insertUniversity($data)
    {
        $this->db->query('INSERT INTO universities(name,address1,address2,town,postcode, longitude, latitude)
                            VALUES(:name,:address1,:address2,:town,:postcode, :longitude, :latitude)');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address1', $data['address1']);
        $this->db->bind(':address2', $data['address2']);
        $this->db->bind(':town', $data['town']);
        $this->db->bind(':postcode', $data['postcode']);
        $this->db->bind(':longitude', $data['longitude']);
        $this->db->bind(':latitude', $data['latitude']);

        $this->db->execute();
    }

    /**
     * Delete a selected university.
     *
     * @param Int $id - The id of the university.
     * @return Bool - True if found, false if not.
     */
    public function deleteUniversity($id)
    {
        $this->db->query('DELETE FROM universities
                            WHERE id = :id');

        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
