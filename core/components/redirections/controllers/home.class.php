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

	class RedirectionsHomeManagerController extends RedirectionsManagerController {
		/**
		 * @acces public.
		 * @param Array $scriptProperties.
		 */
		public function process(array $scriptProperties = array()) {
			$this->addHtml('<script type="text/javascript">
				Ext.onReady(function() {
					Redirections.config.contexts = '.$this->modx->toJSON($this->getContext()).';
				});
			</script>');
		}
		
		/**
		 * @acces public.
		 */
		public function loadCustomCssJs() {
			$this->addJavascript($this->redirections->config['jsUrl'].'mgr/widgets/home.panel.js');
			$this->addJavascript($this->redirections->config['jsUrl'].'mgr/widgets/redirects.grid.js');
			$this->addLastJavascript($this->redirections->config['jsUrl'].'mgr/sections/home.js');
		}
		
		/**
		 * @acces public.
		 * @return String.
		 */
		public function getPageTitle() {
			return $this->modx->lexicon('redirections');
		}
		
		/**
		* @acces public.
		* @return String.
		*/
		public function getTemplateFile() {
			return $this->redirections->config['templatesPath'].'home.tpl';
		}
		
		/**
		 * @acces protected.
		 * @return Array.
		 */
		protected function getContext() {
			$contexts = array();
			
			$query = $this->modx->newQuery('modContext', array('key:NOT IN' => array('mgr')));
			
			foreach ($this->modx->getCollection('modContext', $query) as $key => $context) {
				$contexts[] = array('key' => $key);
			}
			
			return $contexts;
		}
	}

?>