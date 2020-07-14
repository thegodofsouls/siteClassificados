<?php 
     class Categorias{

        public function getLista()
        {
            global $conn;
            $array = array();

            $sql = $conn->query("SELECT * FROM categorias");

            //caso exista categorias cadastradas
            if($sql->rowCount() > 0)
            {
               $array = $sql->fetchAll(); 
            }

            return $array;
        }
}