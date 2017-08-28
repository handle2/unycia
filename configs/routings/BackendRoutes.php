<?php

/**
 * minta routing : létre kell hozni a groupot hozzá kell adni a routing ruleokat aztán mountolni kell a routerba
 */
$group = new \Application\Routing\Group(['namespace' => 'Controllers\\','module' => '']);

$group->addPost('/:controller/nope/:params',[
    'controller' => 1,
    'action' => 'fasz',
    'params' => 3,
]);

$group->addPost('/statikuspost',[
    'controller' => 'index',
    'action' => 'statikus'
]);

$router->mount($group);
