<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface IUpdatable
{
    public function update($id, array $attributes): Model;
}
