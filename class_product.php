<?php

require_once "connect.php";


class product
{
    private PDO $obj;
    public function __construct()
    {
        $con = new connectPDO();
        $this->obj = $con->get_obj();
    }

    //метод для получения количества товара
    public function get_kolvo_product($data)
    {
        $sql = $this->obj->prepare("SELECT `count` FROM `Product` WHERE `id` = :id;");
        $sql->execute([
            ':id' => $data['id'],
        ]);

        $res = $sql->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //метод для получения id и цены товара
    public function get_data_product($data)
    {
        $sql = $this->obj->prepare("SELECT `id`, `price` FROM `Product` WHERE `id` = :id;");
        $sql->execute([
            ':id' => $data['id'],
        ]);

        $res = $sql->fetch(PDO::FETCH_ASSOC);
        return $res;
    }


    //мето для получения id пользователя
    public function get_data_client($email)
    {
        $sql = $this->obj->prepare("SELECT `id` FROM `Client` WHERE `email` = :email;");
        $sql->execute([
            ':email' => $email
        ]);

        $res = $sql->fetch(PDO::FETCH_ASSOC);
        return $res;
    }


    //метод для оформления заказа в корзину
    public function set_data_in_cart($data_product , $data_client)
    {
        $sql = $this->obj->prepare("INSERT INTO `Cart` (`id_client` , `id_product`, `summ_itog`) VALUES (:id_client , :id_product , :summ_itog);");
        $sql->execute([
            ':id_client' => $data_client['id'],
            ':id_product' => $data_product['id'],
            ':summ_itog' => $data_product['count']*$data_product['price']
        ]);
    }

}



?>