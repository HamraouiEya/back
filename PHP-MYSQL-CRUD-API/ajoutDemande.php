<?php
   
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
   header("Access-Control-Max-Age: 3600");
   header("Access-Control-Allow-Headers: Content-Type, 
        Access-Control-Allow-Headers, Authorization, X-Requested-With");
  

    include_once 'config/database.php';
    include_once 'class/demande.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new Demande($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->first_name = $data->first_name;
    $item->last_name = $data->last_name;
    $item->mat = $data->mat;
    $item->pay = $data->pay;
    $item->adr = $data->adr;
    $item->tel = $data->tel;
    $item->mail = $data->mail;
    $item->date_deb = $data->date_deb;
    $item->date_fin = $data->date_fin;
    $item->date_dem = $data->date_dem;
    $item->type_con = $data->type_con;
      
    if($item->ajoutDemande()){
        echo json_encode("demande created.");
    } else{
        echo json_encode("Failed to create demande.");
    }
?>

          