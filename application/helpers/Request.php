<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.08.27.
 * Time: 19:46
 */

namespace Application\Helpers;

/**
 * Ebben tároljuk a requestekkel kapcsolatos függvényeket a DI-ben a helye
 * Class Request
 * @package Application\Helpers
 */
class Request
{
    public function getStringGetParam($index){
        return (string)$_GET[$index];
    }

    public function getIntGetParam($index){
        return (int)$_GET[$index];
    }

    public function getStringPostParam($index){
        return (string)$_POST[$index];
    }

    public function getIntPostParam($index){
        return (int)$_POST[$index];
    }
}