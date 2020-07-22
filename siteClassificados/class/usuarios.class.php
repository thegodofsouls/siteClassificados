<?php
    class Usuarios{

        public function getTotalUsuarios()
        {
            global $conn;

            $sql = $conn->query("SELECT COUNT(*) as c FROM usuarios");
            $row = $sql->fetch();

            return $row['c'];
        }
        
        //funçao de cadastro
        public function cadastrar($nome, $email, $senha, $telefone)
        {
            global $conn;

            $query = "SELECT id FROM usuarios WHERE email = :e";
            $sql = $conn->prepare($query);
            $sql->bindValue(":e", $email);
            $sql->execute();

            if($sql->rowCount() == 0)
            {
                $query = "INSERT INTO usuarios (nome, email, senha, telefone) VALUES (:n, :e, :s, :t)";
                $sql = $conn->prepare($query);
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->bindValue(":t", $telefone);
                $sql->execute();

                return true;

            } 
            else
            {
                return false;
            }
        }

        //funçao de login
        public function login($email, $senha)
        {
           global $conn;

           $query = "SELECT id FROM usuarios WHERE email = :e AND senha = :s";
           $sql = $conn->prepare($query);
           $sql->bindValue(":e", $email);
           $sql->bindValue(":s", md5($senha));
           $sql->execute();

           if($sql->rowCount() > 0)
           {
               //fetch porque vai ser um unico usuario logado
               $dado = $sql->fetch();
               $_SESSION['cLogin'] = $dado['id'];
               return true;
           }
           else
           {
                return false;
           }
        }

        public function getNamelogin() 
        {
            global $conn;
            $sql = $conn->prepare("SELECT email FROM usuarios WHERE id = :i");
            $sql->bindValue(":i", $_SESSION['cLogin']);
            $sql->execute();
            
            if($sql->rowCount() > 0) 
            {
               $nameuser = $sql->fetch();
            }
               return $nameuser;
        } 

    }