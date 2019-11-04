<?php
require 'tad/lib/TADFactory.php';
require 'tad/lib/TAD.php';
require 'tad/lib/TADResponse.php';
require 'tad/lib/Providers/TADSoap.php';
require 'tad/lib/Providers/TADZKLib.php';
require 'tad/lib/Exceptions/ConnectionError.php';
require 'tad/lib/Exceptions/FilterArgumentError.php';
require 'tad/lib/Exceptions/UnrecognizedArgument.php';
require 'tad/lib/Exceptions/UnrecognizedCommand.php';
require 'conn.php';
//https://github.com/cobisja/tad-php
//phpinfo();
$tad_factory = new TADPHP\TADFactory(['ip'=>'192.168.1.201']);
$tad = $tad_factory->get_instance();
//$dt = $tad->get_date();
//var_dump($dt);
//$logs = $tad->get_att_log();


//var_dump($logs->get_response(['format'=>'json']));
//echo json_encode($logs);
//$all_user_info = $tad->get_all_user_info();


//var_dump($tad->get_ip());
//var_dump($all_user_info->get_response_body());
//var_dump($all_user_info->get_response(['format'=>'json']));
//var_dump($all_user_info->get_response(['format'=>'json']));

//var_dump($tad->is_alive());

//var_dump($tad->get_description());
//$fs = $tad->get_free_sizes();

//var_dump($fs->get_response(['format'=>'json']));
//$att_logs = $tad->get_att_logs();
//
//$json_att_logs = $att_logs->to_json();
//
//var_dump($json_att_logs);

//2019-10-05

$att_logs = $tad->get_att_log();
$date = date("Y-m-d");
$att_logs=$att_logs->filter_by_date( ['start' => $date,'end' => $date]);
$json=$att_logs->get_response(['format'=>'json']);

$jsonData= json_decode($json);

$jsonArray= $jsonData->Row;

var_dump($jsonArray);



foreach ($jsonArray as $item){
    $pin = $item->PIN;
    $dateTime= $item->DateTime;

    $stm_check= $pdo->prepare("select * from staff_attendance where pid=? and attendance_date=?");
    $stm_check->execute([$pin, $dateTime]);

    if($stm_check->rowCount()==0){
        $stm = $pdo->prepare('INSERT INTO `staff_attendance`( `pid`, `attendance_date`, `device_id`) VALUES (?,?,?)');
        $stm->execute([$pin, $dateTime, 1]);
    }
}
//var_dump($att_logs->get_response(['format'=>'json']));
//
//// Now, you want filter the resulset to get att logs between '2014-01-10' and '2014-03-20'.
//$filtered_att_logs = $att_logs->filter_by_date(
//    ['start' => '2019-10-05','end' => '2019-10-06']
//);
//
//var_dump($filtered_att_logs->to_json());
//{"Row":[{"PIN":"2","DateTime":"2019-10-05 11:51:20","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-05 11:52:53","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-05 11:52:56","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-05 11:52:58","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-05 12:24:38","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-05 12:24:47","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-05 12:24:49","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-05 12:24:51","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-13 09:25:52","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-17 09:04:38","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-10-19 13:22:05","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:08:01","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:08:04","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:08:06","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:08:33","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:08:36","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:08:38","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:21:39","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:21:45","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:21:51","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:24:38","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-02 14:29:38","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-04 13:05:56","Verified":"1","Status":"255","WorkCode":"0"},{"PIN":"2","DateTime":"2019-11-04 16:12:18","Verified":"1","Status":"255","WorkCode":"0"}]}

//$logs = $tad->get_att_log(['pin'=>2]);

//var_dump($logs->to_json());

//$user_info = $tad->get_user_info(['pin'=>2]);

//var_dump($user_info->to_json());
//$before_password = $tad->get_user_info(['pin' => 2])->to_array();

//var_dump($before_password);
//$all_user_info_items = $tad->get_all_user_info();

//var_dump($all_user_info_items);


//https://github.com/cobisja/tad-php