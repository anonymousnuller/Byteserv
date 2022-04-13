<?php

ob_start();
session_start();

$date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$datetime = $date->format('Y-m-d H:i:s');

/*
 * composer
 */
include_once './vendor/autoload.php';
/*
 * config
 */
include 'app/controller/config.php';
include_once 'app/functions/autoload.php';

include_once 'app/notifications/sendMail.php';

/*
 * page manager
 */
$resources = 'resources/';
$app = 'app/';
$sites = $resources.'sites/';
$auth = $resources.'auth/';
$customer = $resources.'customer/';
$team = $resources.'team/';
$cronjob = $app.'app/cronjob/';

$page = $helper->protect($_GET['page']);

if(isset($_GET['page'])) {
    switch ($page) {

        default: include($sites."404.php");  break;

        //auth
        case "auth_login": include($auth."login.php");  break;
        case "auth_register": include($auth."register.php"); break;
        case "auth_logout": setcookie('session_token', null, time(),'/'); header('Location: '.$helper->url().'login'); break;
        case "auth_activate": include($auth."activate.php"); break;
        case "auth_forgot_password": include($auth."forgot_password.php"); break;


        //index
        case "main_page": include($sites."main_page.php");  break;
        case "dashboard": include($customer."dashboard.php");  break;
        case "support": include($sites."support.php");  break;

        //kvm
        case "kvm_order": include($customer."kvm/order.php");  break;
        case "kvm_manage": include($customer."kvm/manage.php");  break;
        case "kvm_renew": include($customer."kvm/renew.php");  break;
        
        //vserver
        case "vserver_order": include($customer."vserver/order.php");  break;
        case "vserver_manage": include($customer."vserver/manage.php");  break;
        case "vserver_renew": include($customer."vserver/renew.php");  break;	

        //webspace
        case "webspace_order": include($customer."webspace/order.php");  break;
        case "webspace_manage": include($customer."webspace/manage.php");  break;
        case "webspace_renew": include($customer."webspace/renew.php");  break;

        //payment
        case "payment_charge": include($customer."payment/charge.php");  break;
        case "payment_transactions": include($customer."payment/transactions.php");  break;
        case "payment_invoice": include($customer."payment/invoice.php");  break;


        //Support
        case "tickets": include($customer."support/tickets.php");  break;
        case "ticket": include($customer."support/ticket.php");  break;

        //team
        case "team_users": include($team."users.php");  break;
        case "team_user": include($team."user.php");  break;
        case "team_kvms": include($team."kvms.php");  break;
        case "team_kvm": include($team."kvm.php");  break;
        case "team_vservers": include($team."vservers.php");  break;
        case "team_vserver": include($team."vserver.php");  break;
        case "team_webspaces": include($team."webspaces.php");  break;
        case "team_tickets": include($team."tickets.php");  break;
        case "team_ticket": include($team."ticket.php");  break;


        case "runtime_queue": include($app."crone/runtime_queue.php"); break;

    }

    include 'resources/additional/footer.php';

} else {
    die('please enable .htaccess on your server');
}