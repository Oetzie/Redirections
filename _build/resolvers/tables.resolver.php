<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx =& $object->xpdo;
            $modx->addPackage('redirections', $modx->getOption('redirections.core_path', null, $modx->getOption('core_path') . 'components/redirections/') . 'model/');

            $manager = $modx->getManager();

            $manager->createObjectContainer('RedirectionsRedirect');

            break;
    }
}

return true;
