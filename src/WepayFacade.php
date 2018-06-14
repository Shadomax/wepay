<?php
namespace Erss400\Wepay;
use \Illuminate\Support\Facades\Facade;

class WepayFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'wepay';
    }
}