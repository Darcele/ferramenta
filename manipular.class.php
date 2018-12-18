<?php

class Editor{

    private $arquivo = null;

    public function setArquivo($arquivo){
        $this->arquivo = $arquivo;
    }


    public function listarArquivos(){
        $_UP['pasta'] = 'upload';
        $listar = array();
        $za = new ZipArchive;
        $za->open($_UP['pasta'] . '/ferramenta.zip');
        for ($i = 0; $i < $za->numFiles; $i++) 
        {
            $filename = $za->getNameIndex($i);
            if (preg_match("/\./i", $filename)) {
              array_unshift($listar, $filename);
          } 
        }
        $za->close();
        return $listar;
    }

    public function verParametro($arquivo){
        $arquivo = $this->arquivo;        
        $pasta = $_UP['pasta'];
        $parametros = array();
        $zip = new ZipArchive;
        $zip->open($_UP['pasta'] . $arquivos_zip);
        $fileContents = $zip->getFromName($_POST['arquivo']);
        echo $fileContents;
        for($i=0; $i< str_word_count($fileContents); $i++){
            if(preg_match("/{{[^}]*}}/", $fileContents)){
                array_unshift($parametros, $fileContents);
            }
        }
        $zip->close();
        return $parametros;
    }
/*

    public function trocaParametro($string){
        $pasta = $_UP['pasta'];
        $arquivo = $_POST['arquivo'];
        $parametros = $_POST['parametros'];
        $string = $_POST['string'];
        $temp = tempnam('.', 'TMP_');
        copy('$arquivo', $temp);
        $zip = new ZipArchive;
        $fileToModify = '$arquivo';
        if ($zip->open($temp)) {
            $oldContents = $zip->getFromName($fileToModify);
            $newContents = str_replace('$parametros','$string', $oldContents);
            $zip->deleteName($fileToModify);
            $zip->addFromString($fileToModify, $newContents);
            $zip->close();
        }           
        else {
            echo 'failed';
        }   
        unlink($temp);

    }
*/

}
?>