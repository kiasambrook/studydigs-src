<?php

/**
 * The data model for user related queries.
 */
class User
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
   * Handles the insertion into the users table on registration.
   *
   * @param Array $data - Array of data to insert.
   * @return Bool - True if executed, false if not.
   */
  public function register($data)
  {
    $this->db->query('INSERT INTO users (first_name, last_name, email, password, vkey) VALUES(:fname, :lname, :email, :password, :vkey)');
    // Bind values
    $this->db->bind(':fname', $data['fname']);
    $this->db->bind(':lname', $data['lname']);
    $this->db->bind(':vkey', $data['vkey']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Find a user using their email.
   *
   * @param String $email - Email to search for.
   * @return Bool - True if executed, false if not.
   */
  public function findUserByEmail($email)
  {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    // Bind value
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Retrieve a user using their email.
   *
   * @param String $email - Email to search for.
   * @return Bool - Result if executed, false if not.
   */
  public function getUserByEmail($email)
  {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    // Bind value
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return $row;
    } else {
      return false;
    }
  }


  /**
   * Get a user using their id.
   *
   * @param Int $id - Id to search for.
   * @return Bool - Row if executed, false if not.
   */
  public function getUserById($id)
  {
    $this->db->query('SELECT * FROM users WHERE id = :id');
    // Bind value
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return $row;
    } else {
      return false;
    }
  }

  /**
   * Update a user's company id.
   *
   * @param Int $userId - Id of the user to update.
   * @param Object $company - The company object.
   * @return Bool - True if executed, false if not.
   */
  public function updateCompanyId($userId, $company)
  {

    $this->db->query('UPDATE users SET company_id = :company_id WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $userId);
    $this->db->bind(':company_id', $company->id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Update user to state that their email has been verified.
   *
   * @param Int $vkey - The user's unique verification key.
   * @return Bool - True if executed, false if not.
   */
  public function verifyUser($vkey)
  {
    $this->db->query('UPDATE users SET verified = 1 WHERE vkey = :vkey');
    // Bind values
    $this->db->bind(':vkey', $vkey);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Get a user's email and check whether the password is correct.
   *
   * @param String $email - email to search for.
   * @param String $password - Hashed password of user.
   * @return Bool - Result if executed, false if not.
   */
  public function login($email, $password)
  {
    $this->db->query("SELECT * FROM users WHERE email=:email");
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    $hashed_password = $row->password;
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }

  /**
   * Get all users and their companies.
   * 
   * @return Array - Array of users.
   */
  public function getUsers()
  {
    $this->db->query("SELECT *,
                        users.id AS 'userId',
                        users.email as 'userEmail' FROM users
                        inner JOIN `companies` ON `companies`.`id` = `users`.`company_id`");
    return  $this->db->resultSetArray();
  }

  /**
   * Delete select user.
   *
   * @param Int $id - Id of the user.
   * @return Bool - True if executed, false if not.
   */
  public function deleteUser($id)
  {
    $this->db->query("DELETE FROM `users` WHERE id=:id");

    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Update the user details.
   *
   * @param Array $user - User array with details to update.
   * @return Bool - Result if executed, false if not.
   */
  public function updateUser($user)
  {
    $this->db->query("UPDATE users
                        SET first_name = :first_name,
                        last_name = :last_name,
                        email = :email
                        WHERE id = :id");

    $this->db->bind(':id', $user['id']);
    $this->db->bind(':first_name', $user['first_name']);
    $this->db->bind(':last_name', $user['last_name']);
    $this->db->bind(':email', $user['email']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
