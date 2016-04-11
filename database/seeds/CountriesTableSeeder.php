<?php namespace Sanatorium\Addresses\Database\Seeds;

use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
	
		$contents = file_get_contents( __DIR__ . '/../../storage/countries.json' );

		$array_of_countries = json_decode( $contents, true );
		
		if ( is_array($array_of_countries) ) {

			foreach( $array_of_countries as $country ) {

				DB::table('countries')->insert([
					'name_simple' => $country['name']['common'],
					'name' => serialize($country['name']),
					'cca2' => $country['cca2'],
					'ccn3' => $country['ccn3'],
					'cca3' => $country['cca3'],
					'cioc' => $country['cioc'],
					'currency' => serialize($country['currency']),
					'callingCode' => serialize($country['callingCode']),
					'capital' => $country['capital'],
					'altSpellings' => serialize($country['altSpellings']),
					'region' => $country['region'],
					'subregion' => $country['subregion'],
					'tld' => serialize($country['tld']),
					'languages' => serialize($country['languages']),
					'translations' => serialize($country['translations']),
					'latlng' => serialize($country['latlng']),
					'demonym' => $country['demonym'],
					'landlocked' => $country['landlocked'],
					'borders' => serialize($country['borders']),
					'area' => $country['area'],
					'code' => $country['cioc'],
					'delivering' => ($country['region'] == 'Europe' || $country['subregion'] == 'Northern America') ? true : false
				]);

			}
			
		}

	}

}
