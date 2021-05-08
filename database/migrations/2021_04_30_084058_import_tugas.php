<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ImportTugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ini_set('memory_limit', '-1');
        
        Eloquent::unguard();

        $path = 'database/migrations/db_praktikum_prognet.sql';
        $content = file_get_contents($path);
        // dd($content);
        DB::unprepared($content);
        // $this->command->info('All prod/dev table imported!');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
