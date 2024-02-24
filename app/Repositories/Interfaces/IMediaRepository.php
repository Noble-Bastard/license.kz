<?php


namespace App\Repositories\Interfaces;


interface IMediaRepository extends ICreatable, IUpdatable
{
    public function uploadFile(array $attributes) : string;
}
