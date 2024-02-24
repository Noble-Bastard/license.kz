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
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

class ExcelToPdfConvertor extends PdfConvertor
{
    private $spreadsheet;
    private $worksheet;

    public function __construct($srcFileName)
    {
        parent::__construct($srcFileName, 'Pdf');
    }

    protected function convertToPdf(): String
    {
        $this->prepareExcelForConvert();
        IOFactory::registerWriter($this->writerType, Mpdf::class);
        $writer = IOFactory::createWriter($this->spreadsheet, $this->writerType);
        $writer->setTempDir(FilePathHelper::getStoragePath() . "/" . $this->tempMpdfConvertorDir);
        $writer->save(FilePathHelper::getFileFullName($this->destFileName));
        return $this->destFileName;
    }

    private function prepareExcelForConvert(): void
    {
        $this->spreadsheet = IOFactory::load(FilePathHelper::getFileFullName($this->srcFileName));
        $this->worksheet = $this->spreadsheet->getActiveSheet();
        $this->worksheet->setShowGridLines(true);
        $this->prepareExcelImageForConvert();
    }

    private function prepareExcelImageForConvert(): void
    {
        foreach ($this->worksheet->getDrawingCollection() as $drawing) {
            if ($drawing instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                ob_end_clean();
                switch ($drawing->getMimeType()) {
                    case MemoryDrawing::MIMETYPE_PNG :
                        $drawimgExtension = 'png';
                        break;
                    case MemoryDrawing::MIMETYPE_GIF:
                        $drawimgExtension = 'gif';
                        break;
                    case MemoryDrawing::MIMETYPE_JPEG :
                        $drawimgExtension = 'jpg';
                        break;
                }
            } else {
                $zipReader = fopen($drawing->getPath(), 'r');
                $imageContents = '';
                while (!feof($zipReader)) {
                    $imageContents .= fread($zipReader, 1024);
                }
                fclose($zipReader);
                $drawimgExtension = $drawing->getExtension();
            }

            $imgFileName = $this->tempMpdfConvertorDir . "/" . $drawing->getName() . "." . $drawimgExtension;
            Storage::put($imgFileName, $imageContents);
            $drawing->setPath(FilePathHelper::getFileFullName($imgFileName));
        }
    }



}