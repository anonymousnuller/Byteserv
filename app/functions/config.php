<?php

$getConfig = new getConfig();
class getConfig extends Controller
{
    public function getVirtKey()
    {
        include 'app/controller/config.php';
        return $virtualizorKEY;
    }

    public function getVirtPass()
    {
        include 'app/controller/config.php';
        return $virtualizorPASS;
    }

    public function getVirtIP()
    {
        include 'app/controller/config.php';
        return $virtualizorIP;
    }

}
