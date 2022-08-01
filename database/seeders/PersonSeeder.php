<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Person;
use Exception;

class PersonSeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
      Person::truncate();
      $csvFile = fopen(base_path("database/csvData/persons.csv"), "r");
      $firstRow = true;
      while (($data = fgetcsv($csvFile,1000, ",")) !== FALSE) {
          if (!$firstRow) {
              try{
                Person::create([
                      "email" => $data['1'],
                      "name" => $data['2'],
                      "birthday" => $data['3'],
                      "phone" => $data['4'],
                      "ip" => $data['5'],
                      "country" => $data['6']
                  ]); 
              }catch(Exception $e){
                 logger("Some data is not valid:".$e->getMessage());
              }
                
          }
          $firstRow = false;
      }

      fclose($csvFile);
    }
}
