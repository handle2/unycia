<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.08.27.
 * Time: 19:46
 */

namespace Application\Helpers;

/**
 * Majd ebbe lesznek bepakolva az erroral kapcsolatos függvények DI-ben a helye
 * Class Error
 * @package Application\Helpers
 */
class Error
{
    public function riseError($error){
        var_dump($error);die;
    }
}