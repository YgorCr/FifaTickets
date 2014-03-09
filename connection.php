<?php

include('config.php');

class FDB {

  private $db;

  public function __construct()
  {
      try
      {
          $host = $config["dbhost"];
          $name = $config["dbname"];
          $user = $config["dbuser"];
          $pass = $config["dbpass"];
          //instancia o objeto PDO, conectando com o banco postgresql
          $conn = new PDO("pgsql:dbname=ufpbdb;host=localhost;user=postgres;password=postgres");
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->db = $conn;
      }
      catch (PDOException $i)
      {
        //se houver exceção, exibe
        print "Erro: <code>" . $i->getMessage() . "</code>";
      }
  }

  public function execSql($sql, $values)
  {
    echo $sql."<br>";
    if(count($args)==1)
      $values = array();

    try {
      $sth = $this->db->prepare($sql);
      $sth->execute($values);
      $res = array();
      while( ($row = $sth->fetch(PDO::FETCH_ASSOC)) != false)
      {
        $res[] = $row;
      }

      return $res;
    } catch(PDOException $ex) {

      throw new Exception($ex->getMessage());

    }

  }

}

?>
