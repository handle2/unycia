<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.08.27.
 * Time: 16:56
 */

namespace Application\Routing;


use Application\Dependency\Di;
use Application\Helpers\Request;

/**
 * Singleton class ez tárolja a groupeokat és innen indítjuk a routingot
 * Class Router
 * @package Application\Routing
 */
class Router
{
    /**
     * @var Request
     */
    private $_request;

    private $_groups = [];

    /**
     * @var Group
     */
    private $_actualGroup = false;

    /**
     * ezzel pédányosítjuk
     * @return Router|null
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Router();
        }
        return $inst;
    }

    /**
     * privát ,hogy ne tudjuk kinntről példányosítani
     * Elkéri a DI-ből a request osztályt
     * Router constructor.
     */
    private function __construct()
    {
        $di = Di::Instance();
        $this->_request = $di->getDependency('request');
    }

    /**
     * Ezzel töltjük fel az új létrehozott groupeokeat
     * @param Group $group
     */
    public function mount(Group $group){
        $this->_groups[] = $group;
    }

    /**
     * Itt választja ki ,hogy melyik groupe szabályait használja fel (defaultban az elsőt)
     */
    public function route(){

        $url = $this->_request->getStringGetParam('_url');
        $urls = explode('/',$url);
        /**
         * @var Group $group
         */
        foreach ($this->_groups as $group){
            if($urls[0] == $group->getModule()){
                $this->_actualGroup = $group;
            }
        }

        if(!$this->_actualGroup){
            $this->_actualGroup = $this->_groups[0];
        }

        /**
         * @var Route $route
         */
        foreach ($this->_actualGroup->getRoutes() as $route){
            if($route->getUrl() == $url){
                if(!$this->action($route->getRule())){
                    continue;
                }else{
                    return;
                }
            }else{
                if(!$this->loadDynamicRoute($urls,$route)){
                    continue;
                }else{
                    return;
                }
            }
        }
        //todo dobjon hibát ,hogy nincs megfelelő routing vagy 404
        return;
    }

    /**
     * A dinamikus paramétereket itt állítja össze és leellenőrzi ,hogy melyik szabályt hívja meg
     * @param $urls
     * @param Route $route
     * @return boolean
     */
    private function loadDynamicRoute($urls, $route){

        $realUrl = $route->getUrl();

        $finalRule = [];
        foreach ($route->getRule() as $key => $rule){
            if(is_numeric($rule)){
                $realUrl = str_replace(':'.$key,$urls[$rule],$realUrl);
                $finalRule[$key] = $urls[$rule];
            }else{
                $finalRule[$key] = $rule;
            }
        }

        $originalUrl = implode('/',$urls);

        if($realUrl == $originalUrl){
            return $this->action($finalRule);
        }

        return false;
    }

    /**
     * A kiválasztott szabály alapján próbálja meghívni a kellő controllert + actiont és ha kell be is paraméterezi azt
     * @param $finalRule
     * @return bool
     */
    private function action($finalRule){
        $namespace = $this->_actualGroup->getNamespace();

        $controllerName = $namespace.$finalRule['controller'].'Controller';
        unset($finalRule['controller']);

        $actionName = isset($finalRule['action'])?$finalRule['action'].'Action':'indexAction';
        unset($finalRule['action']);

        $params = $finalRule;

        if(count($params) == 1){
            $params = end($params);
        }

        if(file_exists($controllerName.'.php')){
            $controller = new $controllerName();

            if(method_exists($controller,$actionName)){
                if(count($params)>0){
                    $controller->{$actionName}($params);
                }else{
                    $controller->{$actionName}();
                }
            }else{
                echo "nincs ilyen action a ".$controllerName."-ban : ".$actionName."!";
                return false;
            }
        }else{
            echo "nincs ilyen controller ".$controllerName."!";
            return false;
        }

        return true;
    }
}