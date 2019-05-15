<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 09/01/2017
 * Time: 18:03
 */
class Upload
{
    private $File;
    private $Name;
    private $Img;
    private $Url;
    private $maxSize;
    private $Go = 1;
    private $Error;
    private $Recorte;
    // Para Imagens ----------------------


    // Executa os métodos
    public function setImage($File, $maxSize, $Contexto, $Url = null, $Recorte = null)
    {
        $this->File = $File;
        $this->maxSize = $maxSize;
        $this->Recorte = $Recorte;

        if ($Url) {
            if (!is_dir($Url . '/' . $Contexto)) {
                mkdir($Url . '/' . $Contexto, 0777);
            }
            $this->Url = $Url . '/' . $Contexto;
        } else {
            if (!is_dir('../../Uploads/' . $Contexto)) {
                mkdir('../../Uploads/' . $Contexto, 0777);
            }
            $this->Url = '../../Uploads/' . $Contexto;
        }


        $extensao = strchr($this->File['name'], '.');

        $qtd = strlen(strchr($this->File['name'], '.'));
        $name = substr($this->File['name'],0, $qtd + 1);

        $this->Name = trim($name.time() . $extensao);

        $this->verifSize();
        $this->verifTypeImg();

        if ($this->Go != 2) {
            $this->Go = 3;
            $this->toUploadImg();
        }
    }

    public function getName()
    {
        return $this->Name;
    }

    public function getGo()
    {
        return $this->Go;
    }


    public function getError()
    {
        return $this->Error;
    }

    // Verifica tamanho
    private function verifSize()
    {
        if ($this->File['size'] > (1024 * 1024 * $this->maxSize)) {
            $this->Go = 2;
            $this->Error = 'Imagem exece 2 MB.';
        }
    }

    // verifica extensao da img
    private function verifTypeImg()
    {
        if (!in_array($this->File['type'], array('image/jpg', 'image/jpeg', 'image/pjpg', 'image/pjpeg', 'image/png', 'image/x-png'))) {
            $this->Go = 2;
            $this->Error = 'Tipo de imagem não permitido.';
        }
    }


    // Efetua o upload
    private function toUploadImg()
    {
        switch ($this->File['type']) {
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpg':
            case 'image/pjpeg':
                $this->Img = imagecreatefromjpeg($this->File['tmp_name']);
                break;
            case 'image/png':
            case 'image/x-png':
                $this->Img = imagecreatefrompng($this->File['tmp_name']);
                break;
        }


        // Resize

        $oldW = imagesx($this->Img);
        $oldH = imagesy($this->Img);

        // Normal
        if ($this->Recorte == 1) {


            if ($oldW > 3000) {
                $nW = 3000;
                $nH = ($nW * $oldH) / $oldW;
            } else {
                $nW = $oldW;
                $nH = $oldH;
            }

            $newImage = imagecreatetruecolor($nW, $nH);
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            imagecopyresampled($newImage, $this->Img, 0, 0, 0, 0, $nW, $nH, $oldW, $oldH);


            switch ($this->File['type']) {
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpg':
                case 'image/pjpeg':
                    if (imagejpeg($newImage, $this->Url . '/' . $this->Name)) {
                        $this->Go = 3;
                    } else {
                        $this->Go = 2;
                        $this->Error = "Upload da imagem jpg não efetuado";
                    }
                    break;
                case 'image/png':
                case 'image/x-png':
                    if (imagepng($newImage, $this->Url . '/' . $this->Name)) {
                        $this->Go = 3;
                    } else {
                        $this->Go = 2;
                        $this->Error = "Upload da imagem png não efetuado";
                    }
                    break;
            }

        } else {


            // Php 5.2 não suporta
//            $imgCroped = imagecrop($newImage, array("x" => $x, "y" => $y, "width" => 300, "height" => 300));

            switch ($this->File['type']) {
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpg':
                case 'image/pjpeg':

                    $this->setImgCropUser($oldW, $oldH);
                    // Php 5.2 não suporta
//            imagejpeg($imgCroped, $this->Url . '/' . $this->Name);
                    break;
                case 'image/png':
                case 'image/x-png':
                    $this->setImgCropUser($oldW, $oldH);

                    // Php 5.2 não suporta
//                    imagepng($imgCroped, $this->Url . '/' . $this->Name);
                    break;
            }

        }


    }


    // Para Arquivos ----------------------

    public function setFile($File, $maxSize, $Url = null)
    {
        $this->File = $File;
        $this->maxSize = $maxSize;

        if (!is_dir('../../Uploads/Plano_de_Curso')) {
            mkdir('../../Uploads', 0777);
            mkdir('../../Uploads/Plano_de_Curso', 0777);
        }

        $this->Url = (isset($Url)) ? $Url : '../../Uploads/Plano_de_Curso';

        $extensao = strchr($this->File['name'], '.');

        $qtd = strlen(strchr($this->File['name'], '.'));
        $name = substr($this->File['name'],0, $qtd + 1);

        $this->Name = trim($name.time() . $extensao);

        $this->verifSize();
        $this->verifTypeFile();

        if ($this->Go != 2) {
            $this->Go = 3;
            $this->toUploadFile();
        }
    }


    private function verifTypeFile()
    {
        if (!in_array($this->File['type'], array('text/plain', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf'))) {
            $this->Go = 2;
            $this->Error = 'Tipos de arquivos permitidos: .txt, .docx e .pdf.';
        }
    }


    private function toUploadFile()
    {

        move_uploaded_file($this->File['tmp_name'], $this->Url . '/' . $this->Name);

    }


    private function setImgCropUser($oldW, $oldH)
    {
        // Square

        // Ver qual lado é menor
        $W = 300;
        $H = 300;
        if ($oldH > $oldW) {
            $W = 300;
            $H = ($W * $oldH) / $oldW;
        } else if ($oldH < $oldW) {
            $H = 300;
            $W = ($H * $oldW) / $oldH;
        }


        $newImage = imagecreatetruecolor($W, $H);
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);


        // Calculo para cortar a img no meio

        // Se largura maior que altura
        if ($oldH > $oldW) {
            $y = ($H - 300) / 2;
            $x = 0;
        } else if ($oldH < $oldW) {
            $x = ($W - 300) / 2;
            $y = 0;
        } else {
            $x = 0;
            $y = 0;
        }


        imagecopyresampled($newImage, $this->Img, 0, 0, 0, 0, $W, $H, $oldW, $oldH);

        // Biblioteca WideImage para cortar imgs no php 5.2
        require_once('WideImage/WideImage.php');

        $wimg = WideImage::load($newImage);
        $wimg = $wimg->crop($x, $y, 300, 300);
        $wimg->saveToFile($this->Url . '/' . $this->Name);
        // Biblioteca WideImage para cortar imgs no php 5.2
    }
}

