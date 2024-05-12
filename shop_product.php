<?php

require_once "class_product.php";
header('Content-type: application/json');

$main = new product();

$method = $_SERVER['REQUEST_METHOD'];

if($method === "POST")
{
    $how_product_now = $main->get_kolvo_product($_POST); 
    
    // проверяем, что количество товара в таблице больше, чем хочет заказать пользователь
    if($how_product_now['count'] < $_POST['count'])
        {
            http_response_code(400);
            $response['response'] = "нужного количества товара нет на текущий момент в магазине";
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    else if($_POST['count'] == 0) //проверяю, что пользователь заказывает кол-во товара отличное от нуля
            {
                http_response_code(400);
                $response['response'] = "нельзя заказать 0 шт. !";
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
    else
        {
            $data_product_for_cart = $main->get_data_product($_POST);
            $data_product_for_cart['count'] = $_POST['count']; //получаю предварительную информацию о товаре
            
            $data_client_for_cart = $main->get_data_client($_POST['email']); //получаю id пользователя

            $main->set_data_in_cart($data_product_for_cart , $data_client_for_cart); //передаю эти данные по заказу и клиента в корзину

            http_response_code(201);
            $response['response'] = "заказ успешно создан и перенесён в корзину !";
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        }

}



?>