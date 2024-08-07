<?php
require_once 'models/UserDAO.php';

class UserController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    // Function to obtain DAO method getUsers
    public function getUsers()
    {
        $users = $this->userDAO->getAllUsers();
        header('Content-Type: application/json');
        echo json_encode($users);
    }

    // Function to obtain DAO method getUserById
    public function getUserById($id)
    {
        $user = $this->userDAO->getUserById($id);
        header('Content-Type: application/json');
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
    }

    // Function to obtain DAO method createUser
    public function createUser($email, $name, $surname, $job, $password)
    {
        if ($this->isValidEmail($email) && $this->isValidPassword($password) && !$this->userDAO->getUserByEmail($email)) {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $user = $this->userDAO->createUser($email, $name, $surname, $job, $hashedPass);
            header('Content-Type: application/json');
            echo json_encode(['success' => $user]);
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['error' => 'Invalid input or user already exists']);
        }
    }

    // Function to obtain DAO method updateUser
    public function updateUser($id, $email, $name, $surname, $job, $password = null)
    {
        if ($this->isValidEmail($email) && (!$password || $this->isValidPassword($password))) {
            $hashedPass = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
            $user = $this->userDAO->updateUser($id, $email, $name, $surname, $job, $hashedPass);
            header('Content-Type: application/json');
            echo json_encode(['success' => $user]);
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['error' => 'Invalid input']);
        }
    }

    // Function to obtain DAO method deleteUser
    public function deleteUser($id)
    {
        $user = $this->userDAO->deleteUser($id);
        header('Content-Type: application/json');
        echo json_encode(['deleted' => $user]);
    }

    // Function to validate email
    private function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Function to validate password
    private function isValidPassword($password)
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?=.*\d)[A-Za-z\d\W]{8,16}$/', $password);
    }
}
