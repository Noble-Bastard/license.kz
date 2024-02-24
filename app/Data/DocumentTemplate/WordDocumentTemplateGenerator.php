<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;


use App\Data\DocumentTemplate\Helper\ReplacmentItemType;
use App\Data\Helper\FilePathHelper;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;

class WordDocumentTemplateGenerator extends DocumentTemplateGenerator
{

    function __construct($templateFileName) {
        parent::__construct($templateFileName, 'Word2007');
    }

    protected function openDocument($documentFileFullPath): void
    {
        Settings::setTempDir(FilePathHelper::getStoragePath() . "/" . FilePathHelper::getCompanyDocumentTemplateProcessingPath());
        $this->document = new TemplateProcessor($documentFileFullPath);
    }

    protected function applyReplacement(): void
    {
        foreach (collect($this->replacementMap) as $idx => $item) {
            switch($item["type"]){
                case ReplacmentItemType::String:
                    $this->document->setValue($item["key"], $item["replacement"]);
                    break;
                case ReplacmentItemType::ComplexBlock:
                    $this->document->setComplexBlock($item["key"], $item["replacement"]);
            }
        }
    }

    protected function applyImages(): void
    {
        foreach (collect($this->imageList) as $idx => $item) {
            $this->document->setImageValue($item["name"], Storage::path($item["path"]));
        }
    }

    protected function saveDocument(): String
    {

        $this->document->saveAs(FilePathHelper::getFileFullName($this->destFileName));
        return $this->destFileName;
    }
}