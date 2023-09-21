<?php
namespace Controllers;

use \Models\Task;

class Test
{
  public function __construct()
  {
    $this->taskModel = new Task;
  }

  // Render View
  public function tasks()
  {
      // Retrieve all schools and members by default
      $data = [
          'schools' => $this->getSchools(),
          'members' => $this->getMembers(),
      ];
  
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Handle school filter form submission
          $schoolFilter = $_POST['school_filter'];
          if ($schoolFilter != 0) {
              // Use the getMembersForSchool method from the Task model
              $data['members'] = $this->taskModel->getMembersForSchool($schoolFilter);
          }
      }
  
      view('TestDb/tasks', $data);
  }
  

  // CREATE new member
 public function addMember()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $schoolId = $_POST['school_id'];

     
        if ($this->taskModel->createMember($name, $email, $schoolId)) {
            // Memmber created successfully, perform redirection
            header('location: ' . URLROOT . '/test/tasks', true, 303);
            exit; // Exit to prevent further execution
        } else {
            // Member creation failed, provide an error message or log the error
            die("Member creation failed");
        }
    } else {
        // Handle other request methods or cases if needed
    }
}

  // READ all members
  private function getMembers() : array
  {
    return $this->taskModel->selectAll();
  }

  // DELETE members
  public function delete($params)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->taskModel->deleteMember($params['id']))
      header('location: ' . URLROOT . '/test/tasks', true, 303);
    else
      die(MEMEBER_NOT_DELETED);
  }

  private function getSchools() : array
  {
    return $this->taskModel->selectAllSchools();
  }

  public function schoolMembers($schoolId)
{
    $data = [
        'members' => $this->taskModel->getMembersForSchool($schoolId),
        'schools' => $this->getSchools(),
    ];
    view('TestDb/school_members', $data);
}

public function displaySchoolMembers($schoolId)
{
    // Fetch members for the specified school using $schoolId
    $members = $this->taskModel->getMembersForSchool($schoolId);

    // Return the members as JSON data
    header('Content-Type: application/json');
    echo json_encode($members);
    exit;
}
  
}
