<?php

	/**
	 * Redirections
	 *
	 * Copyright 2016 by Oene Tjeerd de Bruin <info@oetzie.nl>
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

	class Redirections {
		/**
		 * @acces public.
		 * @var Object.
		 */
		public $modx;
		
		/**
		 * @acces public.
		 * @var Array.
		 */
		public $config = array();
		
		/**
		 * @acces public.
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
				'helpurl'				=> $this->modx->getOption('namespace', $config, 'redirections'),
				'language'				=> 'redirections:default',
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
				'context'				=> $this->getContexts()
			), $config);	
		
			$this->modx->addPackage('redirections', $this->config['model_path']);
		}
		
		/**
		 * @acces public.
		 * @return String.
		 */
		public function getHelpUrl() {
			return $this->config['helpurl'];
		}
		
		/**
		 * @acces private.
		 * @return Boolean.
		 */
		private function getContexts() {
			$context = array();
			
			foreach ($this->modx->getCollection('modContext') as $value) {
				if ('mgr' != $value->key) {
					$context[] = $value->toArray();
				}
			}
			
			return 1 == count($context) ? 0 : 1;
		}
		
		/**
		 * @acces public.
		 * @return Array.
		 */
		public function getRedirects() {
			$redirects = array();
			
			$criteria = array(
				'context' 		=> $this->modx->context->key,
				'active' 		=> 1
			);
	
			foreach($this->modx->getCollection('RedirectionsRedirects', $criteria) as $key => $value) {
				$redirects[] = $value->toArray();
			}
			
			return $redirects;
		}
	}
	
?>