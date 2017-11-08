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

	class Redirections {
		/**
		 * @access public.
		 * @var Object.
		 */
		public $modx;
		
		/**
		 * @access public.
		 * @var Array.
		 */
		public $config = array();
		
		/**
		 * @access public.
		 * @param Object $modx.
		 * @param Array $config.
		 */
		public function __construct(modX &$modx, array $config = array()) {
			$this->modx =& $modx;
		
			$corePath 		= $this->modx->getOption('redirections.core_path', $config, $this->modx->getOption('core_path').'components/redirections/');
			$assetsUrl 		= $this->modx->getOption('redirections.assets_url', $config, $this->modx->getOption('assets_url').'components/redirections/');
			$assetsPath 	= $this->modx->getOption('redirections.assets_path', $config, $this->modx->getOption('assets_path').'components/redirections/');
			
			$this->config = array_merge(array(
				'namespace'				=> $this->modx->getOption('namespace', $config, 'redirections'),
				'lexicons'				=> array('redirections:default'),
				'base_path'				=> $corePath,
				'core_path' 			=> $corePath,
				'model_path' 			=> $corePath.'model/',
				'processors_path' 		=> $corePath.'processors/',
				'elements_path' 		=> $corePath.'elements/',
				'chunks_path' 			=> $corePath.'elements/chunks/',
				'cronjobs_path' 		=> $corePath.'elements/cronjobs/',
				'plugins_path' 			=> $corePath.'elements/plugins/',
				'snippets_path' 		=> $corePath.'elements/snippets/',
				'templates_path' 		=> $corePath.'templates/',
				'assets_path' 			=> $assetsPath,
				'js_url' 				=> $assetsUrl.'js/',
				'css_url' 				=> $assetsUrl.'css/',
				'assets_url' 			=> $assetsUrl,
				'connector_url'			=> $assetsUrl.'connector.php',
				'version'				=> '1.3.0',
				'branding_url'			=> $this->modx->getOption('redirections.branding_url', null, ''),
				'branding_help_url'		=> $this->modx->getOption('redirections.branding_url_help', null, ''),
				'context'				=> $this->getContexts(),
				'migrate'				=> (bool) $this->modx->getOption('redirections.migrate', null, false)
			), $config);
			
			$this->modx->addPackage('redirections', $this->config['model_path']);
			
			if (is_array($this->config['lexicons'])) {
				foreach ($this->config['lexicons'] as $lexicon) {
					$this->modx->lexicon->load($lexicon);
				}
			} else {
				$this->modx->lexicon->load($this->config['lexicons']);
			}
		}
		
		/**
		 * @access public.
		 * @return String|Boolean.
		 */
		public function getHelpUrl() {
		    if (!empty($this->config['branding_help_url'])) {
                return $this->config['branding_help_url'].'?v=' . $this->config['version'];
            }

            return false;
		}

        /**
         * @access public.
         * @return String|Boolean.
         */
        public function getBrandingUrl() {
            if (!empty($this->config['branding_url'])) {
                return $this->config['branding_url'];
            }

            return false;
        }
		
		/**
		 * @access private.
		 * @return Boolean.
		 */
		private function getContexts() {
			return 1 == $this->modx->getCount('modContext', array(
				'key:!=' => 'mgr'
			));
		}
		
		/**
		 * @access private.
		 * @param Array $context.
		 * @return Array.
		 */
		private function getRedirects($context = array()) {
			$redirects = array();
			
			if (is_string($context)) {
				$context = explode(',', $context);
			}
			
			$c = array(
				'context:IN' 	=> $context + array($this->modx->context->key, ''),
				'active' 		=> 1
			);
	
			foreach ($this->modx->getCollection('RedirectionsRedirects', $c) as $redirect) {
				$redirects[] = $redirect;
			}
			
			return $redirects;
		}
		
		/**
		 * @access public.
		 * @param Array $scriptProperties.
		 */
		public function run($scriptProperties = array()) {
			if ('OnDocFormSave' == $this->modx->event->name) {
				if (isset($scriptProperties['resource'])) {
					if (null !== ($resource = $scriptProperties['resource'])) {
						$this->handleResource($resource);
					}
				}
			} else if ('OnResourceSort' == $this->modx->event->name) {
				if (isset($scriptProperties['nodesAffected'])) {
					foreach ($scriptProperties['nodesAffected'] as $resource) {
						$this->handleResource($resource);
					}
				}
			} else if ('OnPageNotFound' == $this->modx->event->name) {
				$request = trim($_SERVER['REQUEST_URI'], '/');
				$baseUrl = ltrim(trim($this->modx->getOption('base_url', null, MODX_BASE_URL)), '/');
		
				if ('/' != $baseUrl && '' != $baseUrl) {
		    		$request = trim(str_replace($baseUrl, '', $request), '/');
				}
		
				if (!empty($request)) {
					foreach (array_reverse($this->getRedirects()) as $redirect) {				
						$location = $redirect->new;
						
						$regex = preg_quote(trim($redirect->old, '/'));
						$regex = str_replace(array('%', '\^', '\$', '/'), array('(.+?)', '^', '$', '\/'), $regex);
						
						if (!preg_match('/\^/si', $regex) && !preg_match('/\$/si', $regex)) {
							$regex = sprintf('/^%s$/si', $regex);
						} else {
							$regex = sprintf('/%s/si', $regex);
						}
	
						if (preg_match($regex, $request, $matches)) {
							if (is_numeric($location)) {
								$location = $this->modx->makeUrl($location);	
							}
							
							foreach ($matches as $key => $value) {
								$location = str_replace(sprintf('$%s', $key), $value, $location);
							}
	
							if (preg_match('/(\[\[\~([0-9]+)\]\])/si', $location, $matches)) {
								if (isset($matches[2])) {
									$location = str_replace($matches[1], $this->modx->makeUrl($matches[2]), $location);
								}
							}
							
							$location = trim($location, '/');
	
							if ($location != $this->modx->resourceIdentifier) {
								if (!empty($baseUrl)) {
									if (0 === ($pos = strpos($location, $baseUrl))) {
										$location = substr($location, strlen($baseUrl), strlen($location));
									}
								}
	
								$this->modx->sendRedirect($location, array(
									'responseCode' => $redirect->type
								));
							}
						}
					}
					
					$c = array(
						'context'	=> $this->modx->context->key,
						'old' 		=> $request
					);
					
					if (0 == $this->modx->getCount('RedirectionsRedirects', $c)) {
						if (null !== ($redirect = $this->modx->newObject('RedirectionsRedirects'))) {
							$redirect->fromArray(array_merge($c, array(
								'active' => 2
							)));
							
							$redirect->save();
						}
					}
				}	
    		}
		}
		
		/**
		 * @access protected.
		 * @param Object $resource.
		 * @return Boolean.
		 */
		protected function handleResource($resource) {
			if ($resource instanceof modResource) {
				$properties = $resource->getProperties('redirections');
							
				if (isset($properties['uri'])) {
					$oldUrl = trim($properties['uri'], '/');
					$newUrl = trim($resource->get('uri'), '/');
					
					if (!empty($oldUrl) && !empty($newUrl)) {
						if ($oldUrl != $newUrl) {
							$c = array(
								'context'	=> $resource->context_key,
								'old'		=> $newUrl,
								'new'		=> $oldUrl,
								'active:!='	=> 2
							);
							
							if (null === ($redirect = $this->modx->getObject('RedirectionsRedirects', $c))) {
								$c = array(
									'context'	=> $resource->context_key,
									'old'		=> $oldUrl
								);
								
								if (null === ($redirect = $this->modx->getObject('RedirectionsRedirects', $c))) {
									$redirect = $this->modx->newObject('RedirectionsRedirects', $c);
								}
								
								if (null !== $redirect) {
									$redirect->fromArray(array(
										'new' 		=> $newUrl,
										'type'		=> 'HTTP/1.1 301 Moved Permanently',
										'active'	=> 1
									));
									
									$redirect->save();
								}
							} else {
								$redirect->remove();
							}
							
							if ($this->modx->getOption('use_alias_path')) {
								$c = array(
									'context' => $resource->context_key
								);
							
								if ($childResources = $this->modx->getChildIds($resource->id, 1, $c)) {
									foreach ($childResources as $childResource) {
										if (null !== ($childResource = $this->modx->getObject('modResource', $childResource))) {
											$this->handleResource($childResource);
										}
									}
								}
							}
						}
					}
				}
				
				$resource->setProperties(array_merge($properties, array(
					'uri' => trim($resource->get('uri'), '/')
				)), 'redirections');
				
				return $resource->save();
			}
		}
	}
	
?>