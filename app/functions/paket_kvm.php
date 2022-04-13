<?php

$kvmPaket = new kvmPaket;

class kvmPaket extends Controller
{
    public $client;

    public function getData($planName, $data)
    {
        $SQL = self::db()->prepare("SELECT * FROM `kvm_packs` WHERE `name` = :name");
        $SQL->execute(array(":name" => $planName));
        if($SQL->rowCount() == 1){
            $response = $SQL->fetch(PDO::FETCH_ASSOC);
            return $response[$data];
        } else {
            return false;
        }
    }

}