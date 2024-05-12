<?php

require_once "class_cart.php";
header('Content-type: application/json');

$main = new cart();

$method = $_SERVER['REQUEST_METHOD'];

if($method === "POST")
{   
    $status = $main->get_status_in_cart($_POST); //получаем status у заказа по id
    
    //проверяем status, если "не заказан" и такой заказ в корзине существует, то можем оформлять его 
    if($status != false && $status['status'] == "не заказан")
    {
        if($main->updata_product($_POST)) //если списание товара успешно
        {
            $main->modify_status_in_cart($_POST); //меняю статус на "заказан"
            http_response_code(200);
            $response['response'] = "товар успешно заказан !";
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        else
        {
            http_response_code(400);
            $response['response'] = "такого кол-во товара нет в магазине";
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }
    else if($status == false) //если такого заказа не существует в корзине
    {
        http_response_code(400);
        $response['response'] = "нет такого заказа";
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(400);
        $response['response'] = "товар уже заказан";
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}


?>