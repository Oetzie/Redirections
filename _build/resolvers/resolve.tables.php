<?php

    /**
	 * Redirections
	 *
	 * Copyright 2017 by Oene Tjeerd de Bruin <modx@oetzie.nl>
	 *
	 * Redirections is free software; you can redistribute it and/or modify it under
	 * the terms of the GNU General Public License as published by the Free Software
	 * Foundation; either version 2 of the License, or (at your option) any later
	 * version.
	 *
	 * Redirections is distributed in the hope that it will be useful, but WITHOUT ANY
	 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
	 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License along with
	 * Redirections; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
	 * Suite 330, Boston, MA 02111-1307 USA
	 */

    $action = $options[xPDOTransport::PACKAGE_ACTION];

	if ($object->xpdo) {
	    switch ($action) {
	        case xPDOTransport::ACTION_INSTALL:
	            $modx =& $object->xpdo;
	            $modx->addPackage('redirections', $modx->getOption('redirections.core_path', null, $modx->getOption('core_path').'components/redirections/').'model/');
	
	            $manager = $modx->getManager();
	            
	            $manager->createObjectContainer('RedirectionsRedirects');
                
	            break;
	    }
	}
	
	return true;

?>