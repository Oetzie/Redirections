<?php

	if ($object->xpdo) {
	    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
	        case xPDOTransport::ACTION_INSTALL:
	            $modx =& $object->xpdo;
	            $modx->addPackage('offlineip', $modx->getOption('offlineip.core_path', null, $modx->getOption('core_path').'components/offlineip/').'model/');
	
	            $manager = $modx->getManager();
	
	            $manager->createObjectContainer('OfflineIpExceptions');
	
	            break;
	        case xPDOTransport::ACTION_UPGRADE:
	            break;
	    }
	}
	
	return true;