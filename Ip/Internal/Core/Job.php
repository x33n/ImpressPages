<?php


namespace Ip\Internal\Core;

class Job
{
    public static function ipRouteAction_20($info)
    {
        if (!$info['request']->_isWebsiteRoot()) {
            return;
        }

        $req = $info['request']->getRequest();

        if (empty($req)) {
            return;
        }

        $actionString = null;

        if (isset($req['aa'])) {
            $actionString = $req['aa'];
            $controller = 'AdminController';
        } elseif (isset($req['sa'])) {
            $actionString = $req['sa'];
            $controller = 'SiteController';
        } elseif (isset($req['pa'])) {
            $actionString = $req['pa'];
            $controller = 'PublicController';
        }

        if (!$actionString) {
            return;
        }

        $parts = explode('.', $actionString);
        if (count($parts) > 2) {
            ipLog()->warning('Request.invalidControllerAction: {action}', array('action' => $actionString));
            return;
        }

        if (empty($parts[1])) {
            $parts[1] = 'index';
        }

        return array(
            'plugin' => $parts[0],
            'controller' => $controller,
            'action' => $parts[1],
        );
    }

    public static function ipExecuteController_70($info)
    {
        $controllerClass = $info['controllerClass'];
        $action = $info['action'];
        $controller = new $controllerClass();
        if (!$controller instanceof \Ip\Controller) {
            throw new \Ip\Exception($controllerClass . ".php must extend \\Ip\\Controller class.");
        }
        $controllerAnswer = $controller->$action();
        return $controllerAnswer;
    }

}