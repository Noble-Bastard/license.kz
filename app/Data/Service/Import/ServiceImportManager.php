<?php

namespace App\Data\Service\Import;


use App\Data\Helper\FilePathHelper;
use App\Data\Service\Dal\ServiceDal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceImportManager
{
    private $serviceThematicGroupId;
    private $importFileName;
    private $importReader;
    private $importWriter;

    public function __construct()
    {
        $this->importReader = new ServiceImportReader();
        $this->importWriter = new ServiceImportWriter();
    }

    public function import($file, $serviceThematicGroupId)
    {
        $this->serviceThematicGroupId = $serviceThematicGroupId;
        $this->importFileName = $this->storeFileInTempDirectory($file);

        $serviceImportList = $this->importReader->read(
            $this->importFileName
        );

        try
        {
            DB::beginTransaction();

            $serviceIdList = $this->importWriter->write(
                $serviceImportList,
                $this->serviceThematicGroupId
            );

            DB::commit();

            return (new ServiceDal())::getList(
                false,
                null,
                null,
                null,
                $serviceIdList
            );

        } catch  (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        finally{
            Storage::delete($this->importFileName);
        }
    }

    private function storeFileInTempDirectory($file)
    {
        return $file->store(FilePathHelper::getServiceImportTempPath());
    }
}