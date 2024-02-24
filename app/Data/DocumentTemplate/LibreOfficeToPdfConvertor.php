<?php

namespace App\Data\DocumentTemplate;

use App\Data\Helper\FilePathHelper;
use Illuminate\Support\Facades\Log;

class LibreOfficeToPdfConvertor extends PdfConvertor
{

    const CONVERT_CMD = '"%s" --headless --convert-to pdf --outdir %s %s';

    public function __construct($srcFileName)
    {
        parent::__construct($srcFileName, 'Pdf');
    }

    protected function convertToPdf(): String
    {
        $libreOfficePath = config('app.libre_office_path');
        $fullFileName = FilePathHelper::getFileFullName($this->srcFileName);
        $command = sprintf(
            '' . self::CONVERT_CMD . '',
            $libreOfficePath,
            FilePathHelper::getFileDirectory($fullFileName),
            $fullFileName
        );

//        $command = 'export HOME='. FilePathHelper::getStoragePath()
//            . "/" . FilePathHelper::getCompanyDocumentTemplateProcessingPath().' && ' . $command;
        //exec($command. " 2>&1", $output,$return_var);
        $output = shell_exec($command. " 2>&1");

        if($output != "") {
            $errMessage = 'Finish convert to pdf. Exec output: ' .  ': ' . $output;

            $output = shell_exec($libreOfficePath . " --version 2>&1");
            $errMessage .= ' LibreOffice version: ' . ': ' . $output;

            $whoami = shell_exec('whoami');
            $errMessage .= ' Whoami: ' . $whoami;
            Log::info($errMessage);
//            throw new \Exception('CMD:' . $command.'. '. $errMessage);
        }

        return $this->destFileName;
    }

}