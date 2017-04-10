<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 18/12/2015
 * Time: 13:37
 */

/*

$config["meta_user"]["change_password"]["keyword"]     = "Change Password, Forgot Password";
$config["meta_user"]["change_password"]["description"] = "Change Password for Seatizen / Seaman ";
$config["meta_user"]["change_password"]["rating"]      = "general";
$config["meta_user"]["change_password"]["distribution"]= "global";
$config["meta_user"]["change_password"]["google_bot"]  = "no index, no follow";
$config["meta_user"]["change_password"]["robots"]      = "no index, no follow"; */

$config["meta_infr"]["about"] = array(

    array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
    array("name"=>"keyword",     "content"=>"about Informasea, about"),
    array("name"=>"description", "content"=>INFORMASEA_DESC),
    array("name"=>"rating",      "content"=>"general"),
    array("name"=>"distribution","content"=>"global"),
    array("name"=>"google_bot",  "content"=>""),
    array("name"=>"robots",      "content"=>""),
    //array("name"=>"language",  "content"=>""),
    array("name"=>"location",    "content"=>""),
    array("name"=>"author",      "content"=>WEBSITE),
    array("name"=>"copyright",   "content"=>WEBSITE)

);

$config["meta_infr"]["contact"] = array(

    array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
    array("name"=>"keyword",     "content"=>""),
    array("name"=>"description", "content"=>"this is contact of ".WEBSITE),
    array("name"=>"rating",      "content"=>"general"),
    array("name"=>"distribution","content"=>"global"),
    array("name"=>"google_bot",  "content"=>""),
    array("name"=>"robots",      "content"=>""),
    //array("name"=>"language",    "content"=>""),
    array("name"=>"location",    "content"=>"")

);

$config["meta_infr"]["privasi"] = array(

    array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
    array("name"=>"keyword",     "content"=>""),
    array("name"=>"description", "content"=>""),
    array("name"=>"rating",      "content"=>""),
    array("name"=>"distribution","content"=>""),
    array("name"=>"google_bot",  "content"=>""),
    array("name"=>"robots",      "content"=>""),
    //array("name"=>"language",  "content"=>""),
    array("name"=>"location",    "content"=>"")

);
