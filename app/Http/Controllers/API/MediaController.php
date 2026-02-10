<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaFileUploadRequest;
use App\Http\Requests\MediaRequest;
use App\Http\Resources\MediaResource;
use App\Http\Resources\UploadFileResource;
use App\Repositories\Interface\IMediaRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;

class MediaController extends Controller
{

    private $repository;

    public function __construct(IMediaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(MediaRequest $request) : JsonResource
    {
        return new MediaResource($this->repository->create(
            $request->validated()
        ));
    }


    public function update(MediaRequest $request, $newsId) : JsonResource
    {
        return new MediaResource($this->repository->update(
            $newsId,
            $request->validated()
        ));
    }

    public function upload(MediaFileUploadRequest $request) : JsonResource
    {
        $uploadedFilePath = $this->repository->uploadFile(
            $request->validated()
        );

        $result = new stdClass();
        $result->filePath = $uploadedFilePath;

        return new UploadFileResource($result);
    }

}
