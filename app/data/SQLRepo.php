<?php

namespace App\Data;

class SQLRepo implements IRepository
{
    private $con;

    public function __construct(){
        $this->con =  mysqli_connect(getenv('DB_IP'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'), getenv('DB_PORT'));
    }

    public function readAllUsers()
    {
        $stmt = $this->con->prepare("SELECT * from pessoas");
        $stmt->execute();
        $stmt->bind_result($id, $pessoa);

        $content = [];
        while ($stmt->fetch()){
           array_push($content, $pessoa);
        }
        
        $stmt->close();
        $this->con->close();

        return $content;
    }

    public function readUserById($id)
    {
        $stmt = $this->con->prepare("SELECT * from pessoas where id = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $stmt->bind_result($id, $pessoa);

        $userName = null;
        while ($stmt->fetch()){
            $userName = $pessoa;
        }

        $stmt->close();
        $this->con->close();

        return $userName;
    }

    public function deleteUser($id)
    {
        $stmt = $this->con->prepare("DELETE from pessoas where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $this->con->close();
    }

    public function createUser($user){
        $stmt = $this->con->prepare("INSERT INTO pessoas (nome, cpf, data_Nascimento, nome_Mae, sexo) VALUES($user.name, $user.cpf, $user.data_Nascimento, $user.nome_Mae, $user.sexo)");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        return $user;
    }

    public function updateUser($user){
        $stmt = $this->con->prepare("UPDATE pessoas SET (nome, cpf, data_Nascimento, nome_Mae, sexo) VALUES($user.name, $user.cpf, $user.data_Nascimento, $user.nome_Mae, $user.sexo)");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        return $user;
    }
}