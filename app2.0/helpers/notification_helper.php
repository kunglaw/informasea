<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

    if(! function_exists("request_friend")){

        function request_friend($username,$to,$action){

            if(!empty($username) AND !empty($to)){
                $CI =& get_instance();

                $CI->load->model("notifications/notifications_model","notif");

                $CI->notif->request_friend($username,$to,$action);
            }

        }

    }


    if(! function_exists("resume_uncomplete")){

        function resume_uncomplete($username){
            if(!empty($username)){
                $CI =& get_instance();

                $CI->load->model("notifications/notifications_model","notif");

                $CI->notif->resume_uncomplete($username);
            }
        }

    }


    if(! function_exists("expired_certificate")){
        function expired_certificate($username){

            if(!empty($username)){
                $CI =& get_instance();

                $CI->load->model("notifications/notifications_model","notif");

                $CI->notif->expired_certificate($username);
            }


        }
    }
    //seatizen applu job
    if(! function_exists("applied_vacantsea")){
        function applied_vacantsea($username,$to,$id_vacantsea){
            if(!empty($username) AND !empty($to)){
                $CI =& get_instance();

                $CI->load->model("notifications/notifications_model","notif");
                $CI->notif->applied_vacantsea($username,$to,$id_vacantsea);
            }
        }
    }



