<?php

class Editor{

    /*

    private $arquivo = null;

    public function setArquivo($arquivo){
        $this->arquivo = $arquivo;
    }
    */


    public function listarArquivos(){
        $_UP['pasta'] = 'upload';
        $listar = array();
        $za = new ZipArchive;
        $za->open($_UP['pasta'] . '/arquivos_zip.zip');
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
        $_UP['pasta'] = 'upload';
        $parametros = array();
        $zip = new ZipArchive;
        $zip->open($_UP['pasta'] . '/arquivos_zip.zip');
        $fileContents = $zip->getFromName($arquivo);
        $palavras = str_word_count($fileContents,1, "{}");
        foreach($palavras as $palavra){
            if(preg_match('/{{([^}]*)}}/', $palavra, $matches)){
                array_unshift($parametros, $matches[1]);
            }
        }
        $zip->close();
        return $parametros;
    }

    public function deletarArquivo($arquivo){       
        $_UP['pasta'] = 'upload';
        $parametros = array();
        $zip = new ZipArchive;
        $zip->open($_UP['pasta'] . '/arquivos_zip.zip');
        $fileContents = $zip->getFromName($arquivo);
        
        $zip->close();
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