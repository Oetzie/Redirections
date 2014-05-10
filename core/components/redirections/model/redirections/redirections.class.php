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
				'basePath'				=> $corePath,
				'corePath' 				=> $corePath,
				'modelPath' 			=> $corePath.'model/',
				'processorsPath' 		=> $corePath.'processors/',
				'elementsPath' 			=> $corePath.'elements/',
				'chunksPath' 			=> $corePath.'elements/chunks/',
				'snippetsPath' 			=> $corePath.'elements/snippets/',
				'templatesPath' 		=> $corePath.'templates/',
				'assetsPath' 			=> $assetsPath,
				'jsUrl' 				=> $assetsUrl.'js/',
				'cssUrl' 				=> $assetsUrl.'css/',
				'assetsUrl' 			=> $assetsUrl,
				'connectorUrl'			=> $assetsUrl.'connector.php',
				'helpurl'				=> 'redirections'
			), $config);	
		
			$this->modx->addPackage('redirections', $this->config['modelPath']);
		}
		
		/**
		 * @acces public.
		 * @return String.
		 */
		public function getHelpUrl() {
			return $this->config['helpurl'];
		}
		
		/**
		 * @acces public.
		 * @return Array.
		 */
		public function getRedirects() {
			$redirects = array();
	
			foreach($this->modx->getCollection('RedirectionsRedirects', array('context' => $this->modx->context->key, 'active' => 1)) as $key => $value) {
				$redirects[] = $value->toArray();
			}
			
			return $redirects;
		}
	}
	
?>