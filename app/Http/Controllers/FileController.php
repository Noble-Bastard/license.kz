<?php

namespace App\Http\Controllers;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Helper\FilePathHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function showDocs($profileId, $file)
    {

        $profile = ProfileDal::getByUserId(Auth::id());

        if($profileId == $profile->user_id) {
            $path = storage_path() . '/app/docs/' . $profileId . '/'. $file;

            if (file_exists($path)) {
                $type = File::mimeType($path);

                return response(Storage::get('/docs/' . $profileId . '/'. $file), 200, ['Content-Type' => $type]);
            }
        }

        return response()->json(['Status Code' => '404 Not Found'], 404);
    }

    public function showPhoto($profileId, $file)
    {
        $profile = ProfileDal::getByUserId(Auth::id());
        if ($profileId == $profile->id) {
            $path = storage_path() . '/app/profilePhoto/' . $profileId . '/' . $file;

            if (file_exists($path)) {
                $type = File::mimeType($path);

                return response(Storage::get('/profilePhoto/' . $profileId . '/' . $file), 200, ['Content-Type' => $type]);
            }
        }

        return response()->json(['Status Code' => '404 Not Found'], 404);
    }

    public function serviceClientDocShow($serviceJournalId, $file)
    {
        $profile = ProfileDal::getByUserId(Auth::id());

            $path = storage_path() . '/app/' . FilePathHelper::getServiceJournalClientPath($serviceJournalId). '/' . $file;

            if (file_exists($path)) {
                $type = File::mimeType($path);

                return response(Storage::get(FilePathHelper::getServiceJournalClientPath($serviceJournalId) . '/'. $file), 200, ['Content-Type' => $type]);
            }


        return response()->json(['Status Code' => '404 Not Found ' . FilePathHelper::getServiceJournalClientPath($serviceJournalId) . '/'. $file], 404);
    }

    public function serviceAccountantDocShow($serviceJournalId, $file)
    {
        $profile = ProfileDal::getByUserId(Auth::id());

            $path = storage_path() . '/app/' . FilePathHelper::getServiceJournalAccountantDocumentPath($serviceJournalId) . '/' . $file;

            if (file_exists($path)) {
                $type = File::mimeType($path);

                return response(Storage::get(FilePathHelper::getServiceJournalAccountantDocumentPath($serviceJournalId) . '/'. $file), 200, ['Content-Type' => $type]);
            }


        return response()->json(['Status Code' => '404 Not Found ' . FilePathHelper::getServiceJournalAccountantDocumentPath($serviceJournalId) . '/'. $file], 404);
    }

}
