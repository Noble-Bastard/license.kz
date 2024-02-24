<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;

use App\Data\Helper\FilePathHelper;

abstract class  DocumentTemplateGenerator
{
    protected $originalTemplateFileName;
    protected $destFileName;
    protected $replacementMap;
    protected $imageList;
    protected $writerType;
    protected $document;

    function __construct($originalTemplateFileName, $writerType) {
        if($originalTemplateFileName == null)
            throw new \Exception('Template document not defined!');

        $this->originalTemplateFileName = $originalTemplateFileName;
        $this->writerType = $writerType;
        $this->destFileName = FilePathHelper::getCompanyDocumentTemplateProcessingPath()
            . "/" . uniqid(FilePathHelper::getFileBaseNameWithoutExtension($this->originalTemplateFileName) . "_")
            . "." . FilePathHelper::getFileExtension($this->originalTemplateFileName);
    }

    public function generate($replacementMap, $imageList = null): String{
        $this->replacementMap = $replacementMap;
        $this->imageList = $imageList;

        $this->openDocument(FilePathHelper::getFileFullName($this->originalTemplateFileName));
        $this->applyReplacement();
        $this->applyImages();

        return $this->saveDocument();
    }

    protected abstract function openDocument($documentFileFullPath): void;

    protected abstract function applyReplacement(): void;

    protected abstract function applyImages(): void;

    protected abstract function saveDocument(): String;


}
