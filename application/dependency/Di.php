<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.08.27.
 * Time: 19:27
 */

namespace Application\Dependency;

/**
 * Singleton class bele lehet tenni azokat az osztályokat amiket mindenhol el szeretnénk érni
 * Class Di
 * @package Application\Dependency
 */
final class Di
{
    private $_dis = [];

    /**
     * Ezzel lehet példányosítani
     * @return Di|null
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Di();
        }
        return $inst;
    }

    /**
     * azért privát ,hogy ne tudjuk kintről példányosítani
     * Di constructor.
     */
    private function __construct()
    {

    }

    /**
     * kulcsal tudjuk kiszedni az értéket
     * @param $index
     * @return bool|mixed
     */
    public function getDependency($index){
        if(isset($this->_dis[$index])){
            return $this->_dis[$index];
        }
        echo "NINCS ILYEN DEPENDENCIA : ".$index." !";
        return false;
    }

    /**
     * Kulcs alapján rakjuk bele azértéket
     * @param $key
     * @param $value
     */
    public function putDependency($key,$value){
        $this->_dis[$key] = $value;
    }


}