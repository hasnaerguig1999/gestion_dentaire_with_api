<?php

  class Register extends DB {
      public function sign_up($data){
          $sql="INSERT INTO client(uniqId,email,nom,prenom,date_naissance,situation_familiale,adress,date_depart,date_darrive,type_pass,num_pass,type_visa,nationalite) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
          $sql=$this->connect()->prepare($sql);
          if($sql->execute([$data['uniqId'],$data['email'],$data['nom'],$data['prenom'],$data['date_naissance'],$data['situation_familiale'],$data['adress'],$data['date_depart'],$data['date_darrive'],$data['type_pass'],$data['num_pass'],$data['type_visa'],$data['nationalite']]))
               return 1;
          return 0;
      }
      public function login($uniqId){
          $sql="SELECT * FROM client";
          $sql=$this->connect()->prepare($sql);
          $sql->execute();
          $result=$sql->fetchAll();
          foreach($result as $row){
              if(password_verify($uniqId,$row['uniqId'])){
                  return $row['uniqId'];
              }
          }
          return 0;
      }
      public function email_already_exist($email){
          $sql="SELECT * FROM client where email like ?";
          $sql=$this->connect()->prepare($sql);
          if($sql->execute(array($email)))
             if($sql->rowCount())
                return 1;
            return 0;
      }

      // get all clients

      public function read_single($id){
        $sql="SELECT * FROM `client` where uniqId like ?";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute([$id]))
           return $sql->fetch(PDO::FETCH_ASSOC);
        return 0;
      }
  }