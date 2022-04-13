<?php

$virtLXC = new virtLXC();
class virtLXC extends Controller
{
    public function createLXC($userid, $paket){

        $storage = kvmPaket::getData($paket, 'disc');
        $ram = kvmPaket::getData($paket, 'ram');
        $cores = kvmPaket::getData($paket, 'cores');
        $laufzeit = kvmPaket::getData($paket, 'laufzeit');
        $price = kvmPaket::getData($paket, 'price');
        $rootkey = Helper::generateRandomString(12,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!?#$%@');
        $id = Helper::generateRandomString(3,'0123456789');
        $hostname = strtolower('lxc_'.$id);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://'. getConfig::getVirtIP() .':4083/index.php?act=create&api=json&apikey='. getConfig::getVirtKey() .'&apipass='. getConfig::getVirtPass() );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "addvs=1&virt=proxl&rootpass=". $rootkey ."&hostname=". $hostname ."&space=". $storage ."&ram=". $ram ."&swap=0&bandwidth=0&cpu=1024&cores=". $cores ."&ips=1&vnc=0&osid=881&uid=82");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        
        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $output = curl_exec($ch);
        $response = json_decode($output);
        $vpsid = $response->newvs->vpsid;
        $vpsip = $response->newvs->ips[0];
        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+'.$laufzeit.' day');
        $new_date = $date->format('Y-m-d H:i:s');
        $error = $response->error[0];

        if($error == NULL){
            $SQL = self::db()->prepare("INSERT INTO `vserver`(`plan_id`, `user_id`, `virt_id`, `serv_ip`, `root_pw`, `hostname`, `state`, `expire_at`, `price`) VALUES (?,?,?,?,?,?,?,?,?)");
            $SQL->execute(array($paket, $userid, $vpsid, $vpsip, $rootkey, $hostname, 'active', $new_date, $price));
    
            //$SQL2 = $db->prepare("INSERT INTO `user_transactions`(`user_id`, `art`, `amount`, `description`, `created_at`, `updated_at`) VALUES (?,?,?,?,?,?)");
            //$SQL2->execute(array($userid, 'ORDER', $price, 'KVM-Server - ' . $paket, $date->format('Y-m-d H:i:s'), $date->format('Y-m-d H:i:s')));  
        
        } else {
            return $error;
        }

    }


    public function stopLXC($virtid)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://'. getConfig::getVirtIP() .':4083/index.php?svs='. $virtid .'&act=stop&api=json&apikey='. getConfig::getVirtKey() .'&apipass='. getConfig::getVirtPass() .'&do=1');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($ch);
        curl_close($ch);

    }

    public function startLXC($virtid)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://'. getConfig::getVirtIP() .':4083/index.php?svs='. $virtid .'&act=start&api=json&apikey='. getConfig::getVirtKey() .'&apipass='. getConfig::getVirtPass() .'&do=1');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($ch);
        curl_close($ch);

    }

    public function rebootLXC($virtid)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://'. getConfig::getVirtIP() .':4083/index.php?svs='. $virtid .'&act=restart&api=json&apikey='. getConfig::getVirtKey() .'&apipass='. getConfig::getVirtPass() .'&do=1');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($ch);
        curl_close($ch);

    }

    public function deleteLXC($virtid)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://'. getConfig::getVirtIP() .':4083/index.php?delvs='. $virtid .'&act=listvs&api=json&apikey='. getConfig::getVirtKey() .'&apipass='. getConfig::getVirtPass() .'&do=1');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($ch);
        curl_close($ch);

    }

    public function changeRootKey($virtid, $rootpass)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://'. getConfig::getVirtIP() .':4083/index.php?svs='. $virtid .'&act=changepassword&api=json&apikey='. getConfig::getVirtKey() .'&apipass='. getConfig::getVirtPass() .'&do=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "changepass=1&newpass=" . $rootpass ."&conf=" . $rootpass);
    
        $result = curl_exec($ch);
        curl_close($ch);

    }

    public function changeHOSTname($virtid, $hostname)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://'. getConfig::getVirtIP() .':4083/index.php?svs='. $virtid .'&act=hostname&api=json&apikey='. getConfig::getVirtKey() .'&apipass='. getConfig::getVirtPass() .'&do=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "changehost=1&newhost=" . $hostname);
    
        $result = curl_exec($ch);
        curl_close($ch);

    }

    public function ReinstallLXC($virtid, $osid)
    {

        $rootpass = Helper::generateRandomString(8,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!?#$%@');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://'. getConfig::getVirtIP() .':4083/index.php?act=ostemplate&svs='. $virtid .'&api=json&apikey='. getConfig::getVirtKey() .'&apipass='. getConfig::getVirtPass());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "reinsos=1&newos=". $osid ."&newpass=". $rootpass ."&conf=" . $rootpass);
    
        $result = curl_exec($ch);
        curl_close($ch); 
        //print_r($result);

    }


}

?>