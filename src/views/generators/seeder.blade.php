<?php echo '<?php' ?>

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the provinces table
        DB::table(\Config::get('thprovinces.provinces_table'))->delete();

        //Get all of the provinces
        $provinces = ThProvinces::getList();
        foreach ($provinces as $province){
            DB::table(\Config::get('thprovinces.provinces_table'))->insert(array(
                    'id' => $province['id'],
                    'name_th' => $province['name_th'],
                    'name_en' => $province['name_en'],
                    'geography_id' => $province['geography_id']
            ));
        }
    }
}