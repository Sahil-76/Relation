<?php
namespace App\Gates;

class AdminGate{
    public function check_Admin($user){

        if($user->email=='admin@gmail.com'){
            return true;
       }
       else{
           return false;
       } 
    }

}
