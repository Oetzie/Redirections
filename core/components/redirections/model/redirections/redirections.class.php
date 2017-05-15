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
		function __construct(modX &$modx, array $config = array()) {
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
				'version'				=> '1.2.0',
				'branding'				=> (boolean) $this->modx->getOption('redirections.branding', null, true),
				'branding_url'			=> 'http://www.oetzie.nl',
				'branding_help_url'		=> 'http://www.werkvanoetzie.nl/extras/redirections',
				'context'				=> $this->getContexts()
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
		 * @return String.
		 */
		public function getHelpUrl() {
			return $this->config['branding_help_url'].'?v='.$this->config['version'];
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
		 * @return Array.
		 */
		private function getRedirects($context = array()) {
			$redirects = array();
			
			if (is_string($context)) {
				$context = explode(',', $context);
			}
			
			$criteria = array(
				'context:IN' 	=> $context + array($this->modx->context->key, ''),
				'active' 		=> 1
			);
	
			foreach ($this->modx->getCollection('RedirectionsRedirects', $criteria) as $redirect) {
				$redirects[] = $redirect;
			}
			
			return $redirects;
		}
		
		/**
		 * @access public.
		 */
		public function run() {
			$request = $_SERVER['REQUEST_URI'];
			$baseUrl = trim($this->modx->getOption('base_url', null, MODX_BASE_URL));
	
			if ('/' !== $baseUrl && '' != $baseUrl) {
	    		$request = str_replace($baseUrl, '', $request);
			}
	
			$request = trim($request, '/');

			if (!empty($request)) {
				foreach (array_reverse($this->getRedirects()) as $key => $redirect) {
					$regex = preg_quote(ltrim($redirect->old, '/'));
					$regex = str_replace(array('%', '\^', '\$', '/'), array('(.+?)', '^', '$', '\/'), $regex);
					
					if (!preg_match('/\^/si', $regex) && !preg_match('/\$/si', $regex)) {
						$regex = sprintf('/^%s$/si', $regex);
					} else {
						$regex = sprintf('/%s/si', $regex);
					}
	
					if (preg_match($regex, $request, $matches)) {
						if (is_numeric($redirect->new)) {
							$redirect->new = $this->modx->makeUrl($redirect->new );	
						}
						
						foreach ($matches as $key => $value) {
							$redirect->new = str_replace(sprintf('$%s', $key), $value, $redirect->new);
						}

						if (preg_match('/(\[\[\~([0-9]+)\]\])/si', $redirect->new, $matches)) {
							if (isset($matches[2])) {
								$redirect->new = str_replace($matches[1], $this->modx->makeUrl($matches[2]), $redirect->new);
							}
						}

						if ($redirect->new != $this->modx->resourceIdentifier) {
							$baseUrl = ltrim($baseUrl, '/');

							if (!empty($baseUrl)) {
								if (0 === ($pos = strpos(ltrim($redirect->new, '/'), $baseUrl))) {
									$redirect->new = ltrim($redirect->new, '/');

									$redirect->new = substr($redirect->new, strlen($baseUrl), strlen($redirect->new));
								}
							}

							$this->modx->sendRedirect($redirect->new, array(
								'responseCode' => $redirect->type
							));
						}
					}
				}
    		}
		}
	}
	
?>