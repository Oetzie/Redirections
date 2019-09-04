<?php
/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

if (in_array($modx->event->name, ['OnDocFormSave', 'OnResourceSort', 'OnPageNotFound'], true)) {
    $instance = $modx->getService('redirectionsplugins', 'RedirectionsPlugins', $modx->getOption('redirections.core_path', null, $modx->getOption('core_path') . 'components/redirections/') . 'model/redirections/');

    if ($instance instanceof RedirectionsPlugins) {
        $method = lcfirst($modx->event->name);

        if (method_exists($instance, $method)) {
            $instance->$method($scriptProperties);
        }
    }
}