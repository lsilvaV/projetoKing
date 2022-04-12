<?php

class Operacao{
    private $con;

    function __construct()
    {
        require_once dirname(__FILE__). './Conexao.php';

        $bd = new Conexao();

        $this->con = $bd->connect();
    }

    function createCliente($campo_2, $campo_3, $campo_4, $campo_5, $campo_6){
        $stmt = $this->con->prepare("INSERT INTO tbcliente (nomeCli, cpfCli, dataCli, foneCli, endCli) VALUES (?,?,?,?,?)");

        $stmt->bind_param("sisis", $campo_2, $campo_3, $campo_4, $campo_5, $campo_6);
            if($stmt->execute())
                return true;
            return var_dump($stmt);
    }

    function getCliente(){
        $stmt = $this->con->prepare("Select * from tbcliente");
        $stmt->execute();
        $stmt->bind_result($codCli, $nomeCli, $cpfCli, $dataCli, $foneCli, $endCli);

        $dicas = array();

        while($stmt->fetch()){
            $dica = array();
            $dica['codCli'] = $codCli;
            $dica['nomeCli'] = $nomeCli;
            $dica['cpfCli'] = $cpfCli;
            $dica['dataCli'] = $dataCli;
            $dica['foneCli'] = $foneCli;
            $dica['endCli'] = $endCli;

            array_push($dicas,$dica);

        }
        return $dicas;
    }
}

?>