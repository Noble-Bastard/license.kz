<?php


namespace App\Repositories\Interfaces;


interface IDeletable
{
    public function delete($id) : int;
}
