<?php
	/**
	 * Redirections
	 *
	 * Copyright 2013 by Oene Tjeerd de Bruin <info@oetzie.nl>
	 *
	 * This file is part of Redirections, a real estate property listings component
	 * for MODX Revolution.
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

	switch($modx->event->name) {
	    case 'OnPageNotFound':
	    	require_once $modx->getOption('redirections.core_path', null, $modx->getOption('core_path').'components/redirections/').'/model/redirections/redirections.class.php';

	        $redirections = new Redirections($modx);

			$request = $_SERVER['REQUEST_URI'];
			$baseUrl = $modx->getOption('base_url', null, MODX_BASE_URL);

			if (!empty($baseUrl) && '/' !== $baseUrl && ' ' != $baseUrl) {
    			$request = str_replace($baseUrl, '', $request);
			}

			$request = trim($request, '/');

			if (!empty($request)) {
				foreach (array_reverse($redirections->getRedirects()) as $key => $redirect) {
					$regex = preg_quote(ltrim($redirect['old'], '/'));
					$regex = str_replace(array('%', '\?', '\^', '\$', '/'), array('(.+?)', '?', '^', '$', '\/'), $regex);
					$regex = !preg_match('/\^/si', $regex) && !preg_match('/\$/si', $regex) ? sprintf('/^%s$/si', $regex) : sprintf('/%s/si', $regex);

					if (preg_match($regex, $request, $matches)) {
						foreach ($matches as $key => $value) {
							$redirect['new'] = str_replace(sprintf('$%s', $key), $value, $redirect['new']);
						}

						if (preg_match('/(\[\[\~([0-9]+)\]\])/si', $redirect['new'], $matches)) {
							if (array_key_exists('2', $matches)) {
								$redirect['new'] = str_replace($matches[1], $modx->makeUrl($matches[2]), $redirect['new']);
							}
						}

						if ($redirect['new'] != $modx->resourceIdentifier) {
							if (0 === ($pos = strpos(ltrim($redirect['new'], '/'), ltrim($baseUrl, '/')))) {
								$redirect['new'] = ltrim($redirect['new'], '/');

								$redirect['new'] = substr($redirect['new'], strlen(ltrim($baseUrl, '/')), strlen($redirect['new']));
							}

							if (false === strpos($redirect['new'], '://')) {
								$redirect['new'] = $modx->getOption('site_url').ltrim($redirect['new'], '/');
						 	}

						  	$modx->sendRedirect($redirect['new'], array('responseCode' => $redirect['type']));
					  	}
					}
				}
	    	}

	        break;
	}
	
	return;
	
?>