<?php
require_once 'config/config.php';
require_once 'controllers/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$controller = new UserController();

switch ($action) {
    case 'getUsers':
        $controller->getUsers();
        break;
    case 'createUser':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['email'], $data['name'], $data['surname'], $data['job'], $data['password'])) {
            $controller->createUser($data['email'], $data['name'], $data['surname'], $data['job'], $data['password']);
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['error' => 'Invalid input data']);
        }
        break;
    case 'findOneUser':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $controller->getUserById($id);
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['error' => 'ID is required']);
        }
        break;
    case 'updateUser':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id'], $data['email'], $data['name'], $data['surname'], $data['job'])) {
            $controller->updateUser($data['id'], $data['email'], $data['name'], $data['surname'], $data['job'], isset($data['password']) ? $data['password'] : null);
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['error' => 'Invalid input data']);
        }
        break;
    case 'deleteUser':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id'])) {
            $controller->deleteUser($data['id']);
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['error' => 'User ID is required']);
        }
        break;
    default:
        require 'views/index.php';
        break;
}
