<?php

/**
 * The data model for company related queries.
 */
class Company
{
  /**
   * On construction, create a database connection
   */
  public function __construct()
  {
    $this->db = new Database();
  }

  /**
   * On construction, create a database connection
   */
  public function register($data)
  {
    $this->db->query('INSERT INTO companies (name, address1, address2, town, postcode, telephone, email, logo_file_location) VALUES(:name, :address1, :address2, :town, :postcode, :telephone, :email, :logo)');
    // Bind values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':address1', $data['address']);
    $this->db->bind(':address2', $data['address2']);
    $this->db->bind(':town', $data['town']);
    $this->db->bind(':postcode', $data['postcode']);
    $this->db->bind(':telephone', $data['telephone']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':logo', $data['logo_path']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Check whether company exists using the provided email.
   *
   * @param String $email - Email to search for.
   * @return Boolean - True if found, false if not.
   */
  public function getCompanyByEmail($email)
  {
    $this->db->query('SELECT * FROM companies WHERE email = :email');
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
   * Check whether company exists using the provided id.
   *
   * @param String $id - id to search for.
   * @return Boolean - True if found, false if not.
   */
  public function getCompanyById($id)
  {
    $this->db->query('SELECT * FROM companies WHERE id = :id');
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
   * Get array list of all companies.
   *
   * @return Array - List of companies.
   */
  public function getCompanies()
  {
    $this->db->query('SELECT * FROM companies');
    return  $this->db->resultSetArray();
  }

  /**
   * Delete selected company
   *
   * @param String $id - id to delete.
   * @return Boolean - True if executed, false if not.
   */
  public function deleteCompany($id)
  {
    $this->db->query("DELETE FROM `companies` WHERE id=:id");

    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Update selected company.
   *
   * @param Array $company - company to update.
   * @return Boolean - True if executed, false if not.
   */
  public function updateCompany($company)
  {
    $this->db->query("UPDATE companies
                          SET name = :name,
                          address1 = :address1,
                          address2 = :address2,
                          town = :town,
                          postcode = :postcode,
                          telephone = :telephone,
                          email = :email
                          WHERE id = :id");

    $this->db->bind(':id', $company['id']);
    $this->db->bind(':name', $company['name']);
    $this->db->bind(':address1', $company['address1']);
    $this->db->bind(':address2', $company['address2']);
    $this->db->bind(':town', $company['town']);
    $this->db->bind(':postcode', $company['postcode']);
    $this->db->bind(':telephone', $company['telephone']);
    $this->db->bind(':email', $company['email']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
