<?php

use App\Record;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecordChangeWeightToDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $records = Record::all();
        Record::truncate();

        Schema::table('records', function (Blueprint $table) {
            $table->decimal('weight', 7, 1)->change();
        });

        foreach ($records->toArray() as $record) {
            $record['weight'] = str_replace(',', '.', $record['weight']);
            Record::create($record);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            //
        });
    }
}
