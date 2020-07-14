<?php
    class Anuncios{

        public function getMeusAnuncios()
        {
            global $conn;

            $array = array();
            //selecionou todos os campos de anuncios e adicionando a url da tabela anuncios_imagem onde id_anuncio de anuncios_imagem for igual ao id da tabela anuncios
            $sql = $conn->prepare("SELECT *, (select anuncios_imagem.url from 
            anuncios_imagem where anuncios_imagem.id_anuncio = anuncios.id limit 1) 
            as url FROM anuncios WHERE id_usuario = :id_usuario");
            $sql->bindValue(':id_usuario', $_SESSION['cLogin']);
            $sql->execute();

            if($sql->rowCount() > 0)
            {
                $array = $sql->fetchAll();
            }

            return $array; 
        }
       
        public function getAnuncio($id)
        {
            global $conn;
            $array = array();

            $sql = $conn->prepare("SELECT * FROM anuncios WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0)
            {
                $array = $sql->fetch();


                $array['fotos'] = array();
                $sql = $conn->prepare("SELECT id, url FROM anuncios_imagem WHERE id_anuncio = :id_anuncio");
                $sql->bindValue(":id_anuncio", $id);
                $sql->execute();

                if($sql->rowCount() > 0)
                {
                    $array['fotos'] = $sql->fetchAll();
                }
            }

            return $array;
        }

        public function editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $id)
        {
             global $conn;
             $array = array(); 
             $sql = $conn->prepare("UPDATE anuncios SET titulo = :t, id_categoria = :id_categoria, id_usuario = :id_usuario, descricao = :d, valor = :v, estado = :e WHERE id = :id");
             $sql->bindValue(":t", $titulo);
             $sql->bindValue(":id_categoria", $categoria);
             $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
             $sql->bindValue(":d", $descricao);
             $sql->bindValue(":v", $valor);
             $sql->bindValue(":e", $estado);
             $sql->bindValue(":id", $id);
             $sql->execute();

             if(count($fotos) > 0)
             {
                 for($i = 0; $i < count($fotos['tmp_name']); $i++)
                 {
                     $tipo = $fotos['type'][$i];

                     if(in_array($tipo, array('image/jpeg', 'image/png')))
                     {
                         //criando o nome do arquivo
                         $tmpname = md5(time().rand(0,9999).'.jpg');
                         
                         //definindo o caminho do repositorio onde a imagem será salva 
                         move_uploaded_file($fotos['tmp_name'][$i], 'img/anuncios/'.$tmpname);

                         list($width_original, $height_original) = getimagesize('img/anuncios/'.$tmpname);

                         $ratio = $width_original / $height_original;
                         
                         //limites de largura e altura que vão poder ter a imagem
                         $width = 500;
                         $height = 500;

                         if($width / $height > $ratio)
                         {
                             //largura vai ser reduzida para o tamanho da altura original
                             $width = $height * $ratio;
                         }
                         else
                         {
                             $height = $width / $ratio;
                         }

                         $img = imagecreatetruecolor($width, $height);
                         if($tipo == 'image/jpeg')
                         {
                            $original = imagecreatefromjpeg('img/anuncios/'.$tmpname);
                         }
                         else if($tipo == 'image/png')
                         {
                            $original = imagecreatefrompng('img/anuncios/'.$tmpname);
                         }
                         
                         imagecopyresampled($img, $original, 0, 0, 0, 0, $width, $height, $width_original, $height_original);

                         //salvando a imagem na qualidade 80 que é padrao do jpeg
                         imagejpeg($img, 'img/anuncios/'.$tmpname, 80);

                         $sql = $conn->prepare("INSERT INTO anuncios_imagem (id_anuncio, url) VALUES (:id_anuncio, :url)");
                         $sql->bindValue(":id_anuncio", $id);
                         $sql->bindValue(":url", $tmpname);
                         $sql->execute();
                     }
                 }
             }
        }

        public function addAnuncio($titulo, $categoria, $valor, $descricao, $estado)
        {
            global $conn;

            $sql = $conn->prepare("INSERT INTO anuncios (titulo, id_categoria, id_usuario, descricao, valor, estado) VALUES (:t, :id_categoria, :id_usuario, :d, :v, :e)");
            $sql->bindValue(":t", $titulo);
            $sql->bindValue(":id_categoria", $categoria);
            $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
            $sql->bindValue(":d", $descricao);
            $sql->bindValue(":v", $valor);
            $sql->bindValue(":e", $estado);
            $sql->execute();
            
        }

        public function deleteAnuncio($id)
        {
            global $conn;

              //Começa aqui
            //Criando o array vazio como prevenção
           $array = array();
           //Pegar o nome das imagens no banco de dados
           $sql = $conn->prepare("SELECT url FROM anuncios_imagem WHERE id_anuncio = :id");
           $sql->bindValue(":id", $id);
           $sql->execute();
           
           if($sql->rowCount() > 0) 
           {
                $array = $sql->fetchAll();
           }
           //Percorrendo o array com nome das imagens
           foreach ($array as $deleteFile) 
           {
           //Monta a variavel com o nome da foto a ser excluida
           $excluiFoto = 'img/anuncios/'.$deleteFile["url"];
           
              if(file_exists($excluiFoto))
              {
                    //Apaga o arquivo no diretório
                    unlink($excluiFoto);
              }   
           }
        



            $sql = $conn->prepare("DELETE FROM anuncios_imagem WHERE id_anuncio = :id_anuncio");
            $sql->bindValue(":id_anuncio", $id);
            $sql->execute();

            $sql = $conn->prepare("DELETE FROM anuncios WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
        }

        public function deletePhoto($id)
        {
            global $conn;
            $id_anuncio = 0;
            
            //consulta para verificar de qual anuncio a imagem faz parte antes de deleta-la
            $sql = $conn->prepare("SELECT id_anuncio FROM anuncios_imagem WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0)
            {
                $row = $sql->fetch();
                $id_anuncio = $row['id_anuncio'];
            }

            $sql = $conn->prepare("DELETE FROM anuncios_imagem WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            return $id_anuncio;
        }

    }

 