<?php

	/**
	 * Redirections
	 *
	 * Copyright 2017 by Oene Tjeerd de Bruin <info@oetzie.nl>
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

	abstract class RedirectionsManagerController extends modExtraManagerController {
		/**
		 * @access public.
		 * @var Object.
		 */
		public $redirections;
		
		/**
		 * @access public.
		 * @return Mixed.
		 */
		public function initialize() {
			$this->redirections = $this->modx->getService('redirections', 'Redirections', $this->modx->getOption('redirections.core_path', null, $this->modx->getOption('core_path').'components/redirections/').'model/redirections/');
			
			$this->addJavascript($this->redirections->config['js_url'].'mgr/redirections.js');
			
			$this->addHtml('<script type="text/javascript">
				Ext.onReady(function() {
					MODx.config.help_url = "'.$this->redirections->getHelpUrl().'";
					
					Redirections.config = '.$this->modx->toJSON($this->redirections->config).';
				});
			</script>');
			
			return parent::initialize();
		}
		
		/**
		 * @access public.
		 * @return Array.
		 */
		public function getLanguageTopics() {
			return $this->redirections->config['lexicons'];
		}
		
		/**
		 * @access public.
		 * @returns Boolean.
		 */	    
		public function checkPermissions() {
			return $this->modx->hasPermission('redirections');
		}
	}
		
	class IndexManagerController extends RedirectionsManagerController {
		/**
		 * @access public.
		 * @return String.
		 */
		public static function getDefaultController() {
			return 'home';
		}
	}

?>