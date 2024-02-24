<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface ICreatable
{
    public function create(array $attributes): Model;
}
