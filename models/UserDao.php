<?php
require_once 'Database.php';
require_once 'User.php';

class UserDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // Function to obtain all users from DDBB
    public function getAllUsers()
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($result as $row) {
            $users[] = [
                'id' => $row['id'],
                'email' => $row['email'],
                'name' => $row['name'],
                'surname' => $row['surname'],
                'job' => $row['job']
            ];
        }
        return $users;
    }

    // Function to obtain one user from DDBB
    public function getUserById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return [
                'id' => $row['id'],
                'email' => $row['email'],
                'name' => $row['name'],
                'surname' => $row['surname'],
                'job' => $row['job']
            ];
        }
        return null;
    }

    // Function to obtain one user from DDBB
    public function getUserByEmail($email)
    {
        $dataDb = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $dataDb->bindParam(':email', $email, PDO::PARAM_STR);
        $dataDb->execute();
        $row = $dataDb->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return [
                'id' => $row['id'],
                'email' => $row['email'],
                'name' => $row['name'],
                'surname' => $row['surname'],
                'job' => $row['job']
            ];
        }
        return null;
    }

    // Function to create one user into DDBB
    public function createUser($email, $name, $surname, $job, $password)
    {
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('INSERT INTO users (email, name, surname, job, password) VALUES (:email, :name, :surname, :job, :password)');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':job', $job, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPass, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Function to update one user into DDBB
    public function updateUser($id, $email, $name, $surname, $job, $password = null)
    {
        if ($password) {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare('UPDATE users SET email = :email, name = :name, surname = :surname, job = :job, password = :password WHERE id = :id');
            $stmt->bindParam(':password', $hashedPass, PDO::PARAM_STR);
        } else {
            $stmt = $this->db->prepare('UPDATE users SET email = :email, name = :name, surname = :surname, job = :job WHERE id = :id');
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':job', $job, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Function to delete one user from DDBB
    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
