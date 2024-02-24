<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;

use App\Data\Helper\FilePathHelper;
use Illuminate\Support\Facades\Storage;

abstract class PdfConvertor
{
    protected $srcFileName;
    protected $srcExtention;
    protected $destFileName;
    protected $writerType;

    protected $tempMpdfConvertorDir;

    public function __construct($srcFileName, $writerType)
    {
        $this->srcFileName = $srcFileName;
        $this->srcExtention = FilePathHelper::getFileExtension($this->srcFileName);
        $this->destFileName = str_replace($this->srcExtention, 'pdf', $this->srcFileName);
        $this->writerType = $writerType;
    }

    public function convert(): String{
        $this->initMpdfTemporaryDirectory(FilePathHelper::getFileBaseNameWithoutExtension($this->srcFileName));
        $result = $this->convertToPdf();
        Storage::deleteDirectory($this->tempMpdfConvertorDir);
        return $result;
    }

    protected abstract function convertToPdf(): String;

    protected function initMpdfTemporaryDirectory($folderPrefix): void
    {
        $folderPrefix = uniqid($folderPrefix . "_");
        $this->tempMpdfConvertorDir = FilePathHelper::getPdfConvertorTempPath()
            . "/" . $folderPrefix;

        if (!Storage::exists($this->tempMpdfConvertorDir))
            Storage::makeDirectory($this->tempMpdfConvertorDir);
    }


}