<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
header('Content-type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
require_once "2.php";
session_start();

if ($method === 'POST') {
    //проверка, что данные пришли в $_POST
    if (isset($_POST['name']) && isset($_POST['breed'])) {
        if (!isset($_SESSION['posts'])) {
            $_SESSION['posts'] = [];
        }

        $dog = new Dog($_POST['breed'], $_POST['name']);
        //добавляем нового животного в массив 'posts'
        $_SESSION['posts'][] = [
            'respons' => $_POST['lang'] === 'ru' ? $dog->getStrDog() : $dog->getStrDogEn()
        ];

        //отправляем ответ для подтверждения
        echo json_encode(['status' => 'success', 'session' => $_SESSION]);
        exit;
    } else if (isset($_POST['breed_none'])) {
        if (!isset($_SESSION['posts'])) {
            $_SESSION['posts'] = [];
        }

        $cat = new Cat($_POST['name']);

        $_SESSION['posts'][] = [
            'respons' => $_POST['lang'] === 'ru' ? $cat->getStrCat() : $cat->getStrCatEn()
        ];
        echo json_encode(['status' => 'success', 'session' => $_SESSION]);
        exit;
    } else {
        //если ни одно из условий не выполнено, возвращаем ошибку
        echo json_encode(['status' => 'error', 'session' => 'Invalid input']);
        exit;
    }
} else {
    //если метод не POST, возвращаем ошибку
    echo json_encode(['status' => 'error', 'session' => 'Invalid request method']);
    exit;
}
?>