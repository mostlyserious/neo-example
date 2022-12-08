<?php

namespace Modules;

use Craft;
use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public function init()
    {
        Craft::setAlias('@Modules', __DIR__);

        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'Modules\\Console\\Controllers';
        } else {
            $this->controllerNamespace = 'Modules\\Controllers';
        }
    }
}
