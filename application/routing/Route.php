<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.08.27.
 * Time: 19:19
 */

namespace Application\Routing;

/**
 * Segéd class minden route ebben a formában tárolandó
 * Class Route
 * @package Application\Routing
 */
class Route
{
    private $url;
    private $type;
    private $rule;

    public function setUrl($url){
        $this->url = $url;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setRule($rule){
        $this->rule = $rule;
    }

    public function getUrl(){
        return $this->url;
    }

    public function getType(){
        return $this->type;
    }

    public function getRule(){
        return $this->rule;
    }
}