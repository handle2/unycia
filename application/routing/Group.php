<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.08.27.
 * Time: 18:56
 */

namespace Application\Routing;

/**
 * Routing group a mappaszerkezet módosítása miatt fontos eggyszerre több pédány is létezhet belőle a routingban
 * modul alapján olvassa ki az url szabályokat és namespace beállítás kell a controllerekhez
 * Class Group
 * @package Application\Routing
 */
class Group
{
    /**
     * @var string ControllerNamespace
     */
    private $_namespace;

    /**
     * @var string Modul prefix
     */
    private $_module;

    private $_routes = [];

    /**
     * új példány létrehozása esetén meg kell adni neki a namespace-t meg a modult
     * Group constructor.
     * @param $options
     */
    public function __construct($options){
        $this->_namespace = $options['namespace'];
        $this->_module = $options['module'];
    }

    /**
     * ez teszi bele a routing szabályt a routeokba
     * @param $type
     * @param $url
     * @param $rule
     */
    private function addRoute($type,$url,$rule){
        $route = new Route();
        $route->setType($type);
        $route->setUrl($url);
        $route->setRule($rule);

        $this->_routes[] = $route;
    }

    public function addGet($url,$rule){
        $this->addRoute('get',$url,$rule);
    }

    public function addPost($url,$rule){
        $this->addRoute('post',$url,$rule);
    }

    public function addPut($url,$rule){
        $this->addRoute('put',$url,$rule);
    }

    public function addDelete($url,$rule){
        $this->addRoute('delete',$url,$rule);
    }

    public function getRoutes(){
        return $this->_routes;
    }

    public function getModule(){
        return $this->_module;
    }

    public function getNamespace(){
        return $this->_namespace;
    }


}