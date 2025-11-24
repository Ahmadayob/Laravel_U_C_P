<?php

namespace App\Models;

class Job

{

    public static function all(): array
    {
        return[
            ['id' => 1, 'title'=>'software engineer','salary'=>'$1000'],
            ['id' => 2, 'title'=>'graphic designer','salary'=>'$2000']
        ];
    }

}
