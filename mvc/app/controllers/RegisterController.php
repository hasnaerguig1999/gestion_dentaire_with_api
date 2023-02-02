<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class RegisterController{
      public function sign_up(){
          $register=new Register();
            $data=[
              'email'=>trim($_POST['email']),
              'nom'=>trim($_POST['nom']),
              'prenom'=>trim($_POST['prenom']),
              'date_naissance'=>trim($_POST['date_naissance']),
              'situation_familiale'=>trim($_POST['situation_familiale']),
              'adress'=>trim($_POST['adress']),
              'date_depart'=>trim($_POST['date_depart']),
              'date_darrive'=>trim($_POST['date_darrive']),
              'type_pass'=>trim($_POST['type_pass']),
              'num_pass'=>trim($_POST['num_pass']),
              'type_visa'=>trim($_POST['type_visa']),
              'nationalite'=>trim($_POST['nationalite']),
              
              'uniqId'=>password_hash(trim($_POST['uniqId']),PASSWORD_DEFAULT)
            ];
            //$data=json_decode(file_get_contents('php://input'));
            if(empty($data['email']) && empty($data['nom']) && empty($data['prenom']) && empty($data['date_naissance']) && empty($data['adress'])&& empty($data['date_depart'])&& empty($data['date_darrive']) && empty($data['type_pass'])&& empty($data['num_pass'])&& empty($data['type_visa'])&& empty($data['nationalite'])&& empty($data['uniqId']))
              echo "please enter information";
            if($register->email_already_exist($data['email'])){
              echo json_encode(
                array('error' => 'This email is already exist')
                      );
            }elseif($register->sign_up($data)){
              echo json_encode(
                array('message' => 'Sign up success'));
            } 

          }
          public function login(){
            $register=new Register();
            $uniqId=trim($_POST['uniqId']);
            if($_SERVER['REQUEST_METHOD']=='POST'){
              if($register->login($uniqId)){
                echo json_encode(
                  array('message' => 'Login success',
                  'uniqueId' => $register->login($uniqId) ));
              }else{
                echo json_encode(
                  array('message' => 'error Login'));
              }
            }
            
          }
  }