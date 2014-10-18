<?php

	/**
	 * Offline IP
	 *
	 * Copyright 2014 by Oene Tjeerd de Bruin <info@oetzie.nl>
	 *
	 * This file is part of Offline IP, a real estate property listings component
	 * for MODX Revolution.
	 *
	 * Offline IP is free software; you can redistribute it and/or modify it under
	 * the terms of the GNU General Public License as published by the Free Software
	 * Foundation; either version 2 of the License, or (at your option) any later
	 * version.
	 *
	 * Offline IP is distributed in the hope that it will be useful, but WITHOUT ANY
	 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
	 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License along with
	 * Offline IP; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
	 * Suite 330, Boston, MA 02111-1307 USA
	 */

	switch($modx->event->name) {
		case 'OnHandleRequest':
			if (1 !== $modx->getOption('site_status', null, 0)) {
				require_once $modx->getOption('offlineip.core_path', null, $modx->getOption('core_path').'components/offlineip/').'/model/offlineip/offlineip.class.php';

				$offlineIp = new OfflineIp($modx);

				foreach ($offlineIp->getExceptions() as $key => $exception) {
					$regex = preg_quote($exception);
					$regex = str_replace(array('%', '\?', '\^', '\$'), array('\d+', '?', '^', '$'), $regex);
					$regex = !preg_match('/\^/si', $regex) && !preg_match('/\$/si', $regex) ? sprintf('/^%s$/si', $regex) : sprintf('/%s/si', $regex);

					if (preg_match($regex, $_SERVER['REMOTE_ADDR'])) {
						$modx->setOption('site_status', true);

						break;
					}
				}
			}

			break;
	}

	return;
	
?>