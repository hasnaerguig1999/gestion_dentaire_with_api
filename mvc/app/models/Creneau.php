<?php


class Creneau extends DB
{
  public function read($date_creneau)
  {

    date_default_timezone_set('Africa/casablanca');
    $dateToday = date("Y-m-d");

    if ($dateToday == $date_creneau) {
      $sql = "SELECT * FROM creneau where creneau.id not in(SELECT id_creneau FROM rdv where date_creneau=?) and heure_debut >(select curtime())";

      $res = $this->connect()->prepare($sql);
      if ($res->execute(array($date_creneau)))
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }elseif($dateToday < $date_creneau){
      $sql = "SELECT * FROM creneau where creneau.id not in(SELECT id_creneau FROM rdv where date_creneau=?) ";

      $res = $this->connect()->prepare($sql);
      if ($res->execute(array($date_creneau)))
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
  }
  public function read_single($id)
  {
    $sql = "SELECT * FROM creneau where id like ?";
    $sql = $this->connect()->prepare($sql);
    if ($sql->execute(array($id))) {
      if ($sql->rowCount() > 0)
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    return 0;
  }
}
