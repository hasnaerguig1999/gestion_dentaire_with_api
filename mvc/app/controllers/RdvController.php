<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  class RdvController{
      public function index(){
        // echo 'hellooo';
      }
      
      public function read_single_rdv($uniqId){
        if($_SERVER['REQUEST_METHOD']=='GET'){
          $res=new Rdv();
          if($res->read_single_rdv($uniqId)){
            echo json_encode($res->read_single_rdv($uniqId));
          }else{
            echo json_encode(["message"=>"aucun rdv dispo pour ce client"]);
          }
        }else{
          echo json_encode(["message"=>"change method to get"]);
        }
      }
      // public function read($id){
      //   if($_SERVER['REQUEST_METHOD']=='GET'){
      //     $res=new Rdv();
      //     if($res->read($id)){
      //       echo json_encode($res->read($id));
      //     }else{
      //       echo json_encode(["message"=>"id appointment"]);
      //     }
      //   }else{
      //     echo json_encode(["message"=>"change method to get"]);
      //   }
      // }
      public function create(){
        $res=new Rdv();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
          $data=[
            'date_creneau'=>$_POST['date_creneau'],
            'id_creneau'=>$_POST['id_creneau'],
            'uniq_id'=>$_POST['uniq_id'],
            'sjt_rdv'=>$_POST['sjt_rdv']
          ];
          if($res->create($data)){
            echo json_encode(array(
              'message'=>'Appointment created successfully'
            ));
          }else{
            echo json_encode(array(
              'message'=>'Error on created new appointment'
            ));
          }
        }else{
          echo json_encode(array(
            'message'=>'You should change the method to POST'
          ));
        }
      }
      public function delete($id){
        $del=new Rdv();
        $id_rdv=isset($id) ? $id : "this appointment not exist"; 
        if($_SERVER['REQUEST_METHOD']=="POST"){
          if($del->delete($id_rdv)){
            echo json_encode(array(
              "message"=>"Appointment deleted successfully"
            ));
          }else{
            echo json_encode(array(
              "message"=>"Error on deleted appointment"
            ));
          }
        }else{
          echo json_encode(array(
            "message"=>"You should change the method to POST"
          ));
        }
      }

      public function update($id){
        
        $res=new Rdv();
        $data=json_decode(file_get_contents("php://input"));
        // $data=[
        //       'date_creneau'=> $data1->date_creneau,
        //       'id_creneau'=>$data1->id_creneau,
        //       'uniq_id'=>$data1->uniq_id,
        //       'sjt_rdv'=>$data1->sjt_rdv
        //     ]; 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
         
          if($res->update($data,$id)){
            echo json_encode(array(
              'message'=>'Appointment updated successfully'
            ));
          }else{
            echo json_encode(array(
              'message'=>'Error on updated appointment'
            ));
          }
        }else{
          echo json_encode(array(
            'message'=>'You should change the method to POST'
          ));
        }
      }
  }


  


// class rdvController extends DB{
//     private $conn;
    
//       public function __construct(){

//         $this->conn=$this->connect();

//     }



//     // get sing RDV

//     public function read_single($id_RDV){
//       $sql="select * from rdv where id_RDV = ?";
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

//     // Get Single Post
//     // public function read_single($id_produit) {
        
//     //    $sql	="SELECT * FROM `produit` WHERE id = ? ";
//     //    $result=$this->conn->prepare($sql);
//     //   if($result->execute([$id_produit])){

//     //     return $result->fetch(PDO::FETCH_ASSOC);

//     //   } else{ return false;}

    
//     // }
//         // create RDV
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