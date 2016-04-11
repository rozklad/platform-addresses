<?php namespace Sanatorium\Addresses\Widgets;

class Hooks {

	public function register()
	{
		$countries = app('sanatorium.addresses.countries');

		$deliveryCountries = $countries->where('delivering', 1)->get();

		$suggestedCountry = self::suggestCountry();

		$suggestedCountries = [
			'dodaci' => $suggestedCountry,
			'fakturacni' => $suggestedCountry
		];

		return view('sanatorium/addresses::hooks/register', compact('deliveryCountries', 'suggestedCountries'));
	}

	/**
	 * Helper function to suggest country where
	 * the user comes from.
	 * @return [type] [description]
	 */
	public static function suggestCountry()
	{
		$country = null;

		if ( config('sanatorium-shoporders.guess_country') ) {

			/**
			 * Using netimpact
			 * @deprecated
			 */

			if ( false ) {
				$netimpact_key = config('sanatorium-shoporders.netimpact_key');

				$base_uri = 'http://api.netimpact.com/qv1.php?key=%s&qt=geoip&d=json&q=%s';

				$api_url = sprintf( $base_uri, $netimpact_key, $_SERVER['REMOTE_ADDR'] );

				$api_results = json_decode( file_get_contents($api_url) );

				if ( isset($api_results[0]) ) {
					if ( isset($api_results[0][2]) ) {
						$country = $api_results[0][2];
					}
				}
			} else {

				if ( isset($_SERVER['REMOTE_ADDR']) ) {
					$country = self::geoplugin($_SERVER['REMOTE_ADDR'], "Country");
				}

			}
		}

		return $country;
	}

	/**
	 * [geoplugin description]
	 * @see     http://stackoverflow.com/questions/12553160/getting-visitors-country-from-their-ip
	 * @param  [type]  $ip          [description]
	 * @param  string  $purpose     [description]
	 * @param  boolean $deep_detect [description]
	 * @return [type]               [description]
	 */
	public static function geoplugin($ip = NULL, $purpose = 'location', $deep_detect = TRUE) 
	{
	    $output = NULL;
	    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
	        $ip = $_SERVER["REMOTE_ADDR"];
	        if ($deep_detect) {
	            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_CLIENT_IP'];
	        }
	    }
	    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
	    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	    $continents = array(
	        "AF" => "Africa",
	        "AN" => "Antarctica",
	        "AS" => "Asia",
	        "EU" => "Europe",
	        "OC" => "Australia (Oceania)",
	        "NA" => "North America",
	        "SA" => "South America"
	    );
	    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
	        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
	        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
	            switch ($purpose) {
	                case "location":
	                    $output = array(
	                        "city"           => @$ipdat->geoplugin_city,
	                        "state"          => @$ipdat->geoplugin_regionName,
	                        "country"        => @$ipdat->geoplugin_countryName,
	                        "country_code"   => @$ipdat->geoplugin_countryCode,
	                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
	                        "continent_code" => @$ipdat->geoplugin_continentCode
	                    );
	                    break;
	                case "address":
	                    $address = array($ipdat->geoplugin_countryName);
	                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
	                        $address[] = $ipdat->geoplugin_regionName;
	                    if (@strlen($ipdat->geoplugin_city) >= 1)
	                        $address[] = $ipdat->geoplugin_city;
	                    $output = implode(", ", array_reverse($address));
	                    break;
	                case "city":
	                    $output = @$ipdat->geoplugin_city;
	                    break;
	                case "state":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "region":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "country":
	                    $output = @$ipdat->geoplugin_countryName;
	                    break;
	                case "countrycode":
	                    $output = @$ipdat->geoplugin_countryCode;
	                    break;
	            }
	        }
	    }
	    return $output;
	}

}
