<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;

use App\Data\Helper\FilePathHelper;
use PhpOffice\PhpWord\IOFactory;

class WordToPdfConvertor extends PdfConvertor
{

    private $document;

    public function __construct($srcFileName)
    {
        parent::__construct($srcFileName,'PDF');
    }

    protected function convertToPdf(): String
    {
        $this->document = IOFactory::load(FilePathHelper::getFileFullName($this->srcFileName));
        \PhpOffice\PhpWord\Settings::setPdfRendererPath(FilePathHelper::getStoragePath() . "/" . $this->tempMpdfConvertorDir);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('MPDF');
        $writer = IOFactory::createWriter($this->document, $this->writerType);
        $writer->save(FilePathHelper::getFileFullName($this->destFileName));
        return $this->destFileName;
    }


}