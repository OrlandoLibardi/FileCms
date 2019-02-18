<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use OrlandoLibardi\OlCms\AdminCms\app\Admin;


class AdminFilesCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {       
        
        Admin::create([
            'name' => 'G. Imagens',
            'route' => 'files',
            'icon' => 'fa fa-cloud',
            'parent_id' => 0,
            'minimun_can' => 'edit',
            'order_at' => 9
        ]);
       
    }
}
