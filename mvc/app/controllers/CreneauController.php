<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers:*');
class CreneauController
{
      public function read($date)
      {
            $res = new Creneau();
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                  if ($res->read($date)) {
                        echo json_encode($res->read($date));
                  } else {
                        echo json_encode(["message" => "aucun creneau dipso pour le moment"]);
                  }
            } else  echo json_encode(
                  array('message' => 'change method to GET')
            );
      }
}
