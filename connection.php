<?php

require_once('config.php');

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
          //instancia o objeto PDO, conectando com o banco mysql
          // $conn = new PDO("mysql:host=$host;port=3306;dbname=$name", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
          $conn = new PDO("pgsql:host=$host dbname=$name user=$user password=$pass");
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
    try {
      $sth = $db->prepare($sql);
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
