<?php

/**
 * The data model for admin related queries.
 */
class Admin
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
     * Check whether the user exists from the username.
     *
     * @param String $username - Search for the username.
     * @return Boolean - True if found, false if not.
     */
    public function findUserByUsername($username)
    {
        $this->db->query('SELECT * FROM admins WHERE username = :username');
        // Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    /**
     * Check whether the password is correct.
     *
     * @param String $username - Search for the username.
     * @param String $password - Search for the hashed password.
     * @return Boolean - True if found, false if not.
     */
    public function login($username, $password)
    {
        $this->db->query("SELECT * FROM admins WHERE username=:username");
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }
}
