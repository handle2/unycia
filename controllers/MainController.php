<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.08.28.
 * Time: 14:52
 */

namespace Controllers;

/**
 * Minta controller tesztekhez
 * Class MainController
 * @package Controllers
 */
class MainController extends BaseController
{
    public function __construct(){
        echo "dafaq<br/>";
    }

    public function faszAction($params){
        var_dump($params);
        echo "<br/>TE FASZ!";
    }
}