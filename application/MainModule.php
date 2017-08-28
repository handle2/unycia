<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.08.27.
 * Time: 16:49
 */

namespace Application;


use Application\Dependency\Di;
use Application\Helpers\Error;
use Application\Helpers\Request;
use Application\Routing\Router;

class MainModule
{
    /**
     * Itt van az autoloader ide húzzuk be a configokat is és ebben hívjuk meg a dependencyInjectiont is
     * MainModule constructor.
     */
    public function __construct(){
        spl_autoload_register(function ($class_name) {
            require_once $class_name . '.php';
        });

        $this->dependencyInjection();


        $router = Router::Instance();

        require_once 'configs/routings/BackendRoutes.php';

        $router->route();
    }

    /**
     * itt állítjuk össze a szükséges dependenciákat
     */
    private function dependencyInjection(){
        $di = Di::Instance();
        $request = new Request();
        $error = new Error();
        $di->putDependency('request',$request);
        $di->putDependency('error',$error);
    }
}