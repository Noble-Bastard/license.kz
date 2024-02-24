<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;

use App\Data\Helper\FilePathHelper;

class PdfConvertorManager
{
    public static function getConvertor($fileName): PdfConvertor
    {
        $libreOfficePath = config('app.libre_office_path');
        if(!is_null($libreOfficePath)){
            return new LibreOfficeToPdfConvertor($fileName);
        }

        $extension = FilePathHelper::getFileExtension($fileName);
        if($extension == 'xls' || $extension == 'xlsx')
            return new ExcelToPdfConvertor($fileName);
        elseif ($extension == 'doc' || $extension == 'docx')
            return new WordToPdfConvertor($fileName);
        else
            throw new \Exception("Pdf Convertor for extention %s not defined!");
    }
}



