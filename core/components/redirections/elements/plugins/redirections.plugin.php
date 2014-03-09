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
				$redirects = $modx->getCollection('Redirects', array('context' => $modx->context->key, 'active' => 1));

				foreach ($redirects as $redirect) {
					$redirect = $redirect->toArray();

					if (preg_match('/^'.str_replace('%', '(.+?)', preg_quote(ltrim($redirect['old'], '/'), '/')).'$/i', $request)) {
						if (preg_match('/^(\[\[\~([0-9]+)\]\])$/', $redirect['new'], $matches)) {
							if (isset($matches[2])) {
								$redirect['new'] = $modx->makeUrl($matches[2]);
							}
						}

						if ($redirect['new'] != $modx->resourceIdentifier && $redirect['new'] != $search) {
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