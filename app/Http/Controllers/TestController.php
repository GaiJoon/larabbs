<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class TestController extends Controller
{
    public function Index()
    {
        $models = [$model, $model, $model];

        $id_to_title = array_combine(
            array_column($models, 'id'),
            array_column($models, 'title')
        );

        print_r($id_to_title);
    }
}
