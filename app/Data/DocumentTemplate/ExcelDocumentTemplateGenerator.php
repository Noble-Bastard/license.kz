<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;

use App\Data\Helper\FilePathHelper;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ExcelDocumentTemplateGenerator extends DocumentTemplateGenerator
{
    private $worksheet;

    function __construct($originalTemplateFileName)
    {
        parent::__construct($originalTemplateFileName, 'Xlsx');
    }

    protected function openDocument($documentFileFullPath): void
    {
        $this->document = IOFactory::load($documentFileFullPath);
        $this->worksheet = $this->document->getActiveSheet();
    }

    protected function applyReplacement(): void
    {
        foreach ($this->worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            foreach ($cellIterator as $cell) {
                $originalCellValue = $cellValue = $cell->getValue();
                if($cellValue != null) {
                    foreach (collect($this->replacementMap) as $idx => $item) {
                        if (strpos($cellValue, $item["key"]) !== false)
                            $cellValue = str_replace($item["key"], $item["replacement"], $cellValue);
                    }
                    if ($originalCellValue !== $cellValue)
                        $cell->setValue($cellValue);
                }
            }
        }
    }

    protected function saveDocument(): String
    {
        $writer = IOFactory::createWriter(
            $this->document,
            $this->writerType
        );
        $writer->save(FilePathHelper::getFileFullName($this->destFileName));
        return $this->destFileName;
    }

    protected function applyImages(): void
    {
        // TODO: Implement applyImages() method.
    }

}