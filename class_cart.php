<?php

require_once "connect.php";


class cart
{
    private PDO $obj;
    public function __construct()
    {
        $con = new connectPDO();
        $this->obj = $con->get_obj();
    }


    //метод для получения id продукта и суммы из корзины
    public function get_id_product($data): array
    {
        $sql = $this->obj->prepare("SELECT `id_product` , `summ_itog` FROM `Cart` WHERE `id` = :id;");
        $sql->execute([
            ':id' => $data['id']
        ]);

        $res = $sql->fetch(PDO::FETCH_ASSOC);
        return $res;
    }


    //метод для обновление статуса в корзине
    public function modify_status_in_cart($data): void
    {
        $sql = $this->obj->prepare("UPDATE `Cart` SET `status` = :status WHERE `id` = :id;");
        $sql->execute([
            ':id' => $data['id'],
            ':status' => "заказан"
        ]);
    }

    
    //метод для обновление столбца count в таблице Product
    //при оформление заказа в корзине, количество товара в таблице Product должно уменьшиться на то количество, которое заказал пользователь)
    public function updata_product($data): bool
    {
        $id_product = $this->get_id_product($data);

        $temp = $this->obj->prepare("SELECT `price`, `count` FROM `Product` WHERE `id` = :id;");
        $temp->execute([
            ':id' => $id_product['id_product']
        ]);

        $res = $temp->fetch(PDO::FETCH_ASSOC);

        $sql = $this->obj->prepare("UPDATE `Product` SET `count` = :kolvo WHERE `id` = :id;");

        if($res['count'] >= ($id_product['summ_itog']/$res['price']))
        {
            $sql->execute([
                ':id' => $id_product['id_product'],
                ':kolvo' => $res['count'] - ($id_product['summ_itog']/$res['price'])
            ]);
            return true;
        }
        else
            return false;
    }


    //метод для получения статуса в корзине
    public function get_status_in_cart($data): array | bool
    {
    $sql = $this->obj->prepare("SELECT `status` FROM `Cart` WHERE `id` = :id;");
    $sql->execute([
        ':id' => $data['id']
    ]);

    $res = $sql->fetch(PDO::FETCH_ASSOC);

    if(empty($res))
        return false;

    return $res;
    }

}

?>