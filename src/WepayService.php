<?php

namespace Erss400\Wepay;

use WePay;

class WepayService {

    private $wepay;

    public function __construct($client_id, $client_secret, $api_version, $env, $access_token) {
		$clientId = $this->validate($client_id, null);

		$clientSecret = $this->validate($client_secret, [], true);

		$apiVersion = $this->validate($api_version, [], true);

		$environment = $this->validate($env, [], true);

		$accessToken = $this->validate($access_token, [], true);

        if ($environment === 'production') {
        	# initiate new wepay production server.
        	WePay::useProduction($clientId, $clientSecret, $apiVersion);
        } else {
        	// initiate new wepay staging server
        	WePay::useStaging($clientId, $clientSecret, $apiVersion);
        }

        $this->wepay = new WePay($accessToken);

    }

	private function validate($val, $default, $json = false) {
		if (!empty($val) && is_string($val)) {
			if ($json) {
				return json_decode($val, true);
			}
			return $val;
		}
		return $default;
	}

    public function get() {
        return $this->wepay;
    }
}