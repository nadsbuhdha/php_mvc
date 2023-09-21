<?php
namespace Models;

use \Models\Database;

class Task
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  /**
   * CREATE
   * @return boolean
   */
  public function createMember( $name, $email, $schoolId): bool
{
    $this->db->query("INSERT INTO members (`name`, `email`, school_id) VALUES (:name, :email, :school_id)");
    $this->db->bind(':name', $name);
    $this->db->bind(':email', $email);
    $this->db->bind(':school_id', $schoolId);

    if ($this->db->execute()) {
        return true;
    }
    
    return false;
}
  
  

  /**
   * READ
   * @return array
   */
  public function selectAll() : array
  {
    $this->db->query("SELECT * FROM members");
    return $this->db->resultSet();
  }

  /**
   * DELETE
   * @return boolean
   */
  public function deleteMember($id) : bool
  {
    $this->db->query("DELETE FROM members WHERE id = :id");
    $this->db->bind(':id', $id);
    if ($this->db->execute())
      return true;
    return false;
  }
  
   public function selectAllSchools() : array
    {
        $this->db->query("SELECT * FROM schools");
        return $this->db->resultSet();
    }

/**
 * READ members for a specific school
 * @param int $schoolId
 * @return array
 */
public function getMembersForSchool($schoolId): array
{
    $this->db->query("SELECT * FROM members WHERE school_id = :school_id");
    $this->db->bind(':school_id', $schoolId);
    return $this->db->resultSet();
}
    
}


