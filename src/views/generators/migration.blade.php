<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvincesTable extends Migration
{

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        // Creates the provinces table
        Schema::create('{{ $provincesTable }}', function(Blueprint $table)
        {
            $table->integer('id')->index();
            $table->code('country_id');
            $table->string('name_th', 255);
            $table->string('name_en', 255);
            $table->unsignedInteger('geography_id');

            $table->primary('id');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('{{ $provincesTable }}');
    }

}