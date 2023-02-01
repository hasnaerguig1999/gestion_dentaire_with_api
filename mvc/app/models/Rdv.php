<?php


    
  class Rdv extends DB{
    public function read($id){
      $sql="SELECT * FROM rdv  where id like ? ";
      $sql=$this->connect()->prepare($sql);
      if($sql->execute([$id])){
        if($sql->rowCount()>0)
          return $sql->fetchAll(PDO::FETCH_ASSOC);
      }return 0;
    }
      public function read_single_rdv($id){
        $sql="SELECT r.id,r.id_creneau,r.uniq_id, sjt_rdv , date_creneau, heure_debut , heure_fin  FROM rdv r join creneau c on r.id_creneau =c.id  where  uniq_id = ?  ";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute([$id])){
          if($sql->rowCount()>0)
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }return 0;
      }
      public function create($data){
        $reg=new Register();
        $cre=new Creneau();
        if($reg->read_single($data['uniq_id']) && $cre->read_single($data['id_creneau'])){
          $sql="INSERT INTO `rdv` (`date_creneau`, `id_creneau`, `uniq_id`, `sjt_rdv`) VALUES (?, ?, ?, ?)";
          $sql=$this->connect()->prepare($sql);
          if($sql->execute([$data["date_creneau"],$data["id_creneau"],$data["uniq_id"],$data["sjt_rdv"]])){
          return 1;
        }return 0;
        }
      }
      public function delete($id){
          $sql="DELETE from `rdv` where id = ?";
          $sql=$this->connect()->prepare($sql);
          if($sql->execute([$id])){
            return 1;
          }return 0;
      }
      public function update($data,$id){
        $reg=new Register();
        $cre=new Creneau();
          $sql="UPDATE `rdv` SET `sjt_rdv` = ? WHERE `rdv`.`id` = ?";
          $sql=$this->connect()->prepare($sql);
          if($sql->execute([$data->sjt_rdv,$id])){
            return 1;
         
        }return 0;
      }
  }



// class RDV extends DB{
//     private $conn;
    
//       public function __construct(){

//         $this->conn=$this->connect();

//     }



//     // get sing RDV

//     public function read_single($id_RDV){
//       $sql="select * from rdv where id_RDV = ?"
//       $result=$this->conn->prepare($sql);

//       if($result->execute([$id_RDV])){
//         return $result->fetch(PDO::FETCH_ASSOC);
         
//       }else return false;

//     }



//     // reads rdv for single client
//     public function  read($id_client){


//         $sql = 'SELECT  sjt_RDV , date_creneau, heure_debut , heure_fin  FROM rdv r join creneau c on r.id_creneau =c.id_creneau  where  id_client = ?  ';

//         $result= $this->conn->prepare($sql);
        
//         if($result->execute([$id_client])){

//             return $result->fetchAll(PDO::FETCH_ASSOC);
      
//             } else{ return false;}
      

    
//     }

    // Get Single Post
    // public function read_single($id_produit) {
        
    //    $sql	="SELECT * FROM `produit` WHERE id = ? ";
    //    $result=$this->conn->prepare($sql);
    //   if($result->execute([$id_produit])){

    //     return $result->fetch(PDO::FETCH_ASSOC);

    //   } else{ return false;}

    
    // }
        // create RDV
//         public function create($data){
//           //create instance client and creneau
//           $client=new Client();
//           $creneau=new Creneau();
//           // check existance foreign key
//             if( ($client->read_single( $data->id_client)) &&( $creneau->read_single( $data->id_creneau)))
//                   {
//                        //  clean data
//                       $data->sjt_RDV = htmlspecialchars(strip_tags( $data->sjt_RDV));
//                       $data->date_creneau = htmlspecialchars(strip_tags( $data->date_creneau));
//                       $sql=" INSERT INTO `rdv` (`sjt_RDV`, `date_creneau`, `id_client`, `id_creneau`) VALUES ( :sjt_RDV,:date_creneau,:id_client,:id_creneau)";
//                       $result=$this->conn->prepare($sql);
//                        // Bind data
//                       return  $result->execute([':sjt_RDV'=>$data->sjt_RDV,
//                       ':date_creneau'=>$data->date_creneau,
//                       ':id_client'=>$data->id_client,
//                       ':id_creneau'=>$data->id_creneau]);
//                   }
//         }

//         // update RDV
//         public function update($data){
//            //create instance client and creneau
//           $client=new Client();
//           $creneau=new Creneau();
//           // check existance foreign keys && primaryKey 
//            if( ($client->read_single( $data->id_client)) &&( $creneau->read_single( $data->id_creneau)) && ($this->read_single($data->id_RDV)))
//                 {
//                     $sql="update rdv set sjt_RDV = :sjt_RDV , date_creneau= :date_creneau ,id_client = :id_client, id_creneau = :id_creneau where id_RDV=:id_RDV";
//                     $result=$this->conn->prepare($sql);
//                     //  clean data
//                     $data->sjt_RDV = htmlspecialchars(strip_tags( $data->sjt_RDV));
//                     $data->date_creneau = htmlspecialchars(strip_tags( $data->date_creneau));
//                     // Bind data 
//                     return  $result->execute([':sjt_RDV'=>$data->sjt_RDV,
//                     ':date_creneau'=>$data->date_creneau,
//                     ':id_client'=>$data->id_client,
//                     ':id_creneau'=>$data->id_creneau,
//                     ':id_RDV'=>$data->id_RDV]);

//                  }else {return false;}      
                 
//   }
        
//         // delete RDV
//         public function delete($id_RDV){
//           $sql="delete from rdv where id_RDV = :id_RDV";
//           $result=$this->conn->prepare($sql);
//           //  clean data
//           $id_RDV = htmlspecialchars(strip_tags($id_RDV));
//           //bind data
//           if($this->read_single($id_RDV)){
//             return  $result->execute([':id_RDV'=>$id_RDV]);
//          } else {return false;}
        

//         }



        

    
// }




?>