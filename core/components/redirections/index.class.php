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

	abstract class RedirectionsManagerController extends modExtraManagerController {
		/**
		 * @acces public.
		 * @var Object.
		 */
		public $redirections;
		
		/**
		 * @acces public.
		 * @return Mixed.
		 */
		public function initialize() {
			require_once $this->modx->getOption('redirections.core_path', null, $this->modx->getOption('core_path').'components/redirections/').'/model/redirections/redirections.class.php';
			
			$this->redirections = new Redirections($this->modx);
			
			$this->addJavascript($this->redirections->config['jsUrl'].'mgr/redirections.js');
			$this->addHtml('<script type="text/javascript">
				Ext.onReady(function() {
					MODx.config.help_url = "http://rtfm.modx.com/extras/revo/'.$this->redirections->getHelpUrl().'";
			
					Redirections.config = '.$this->modx->toJSON($this->redirections->config).';
				});
			</script>');
			
			return parent::initialize();
		}
		
		/**
		 * @acces public.
		 * @return Array.
		 */
		public function getLanguageTopics() {
			return array('redirections:default', 'setting');
		}
		
		/**
		 * @acces public.
		 * @returns Boolean.
		 */	    
		public function checkPermissions() {
			return true;
		}
	}
		
	class IndexManagerController extends RedirectionsManagerController {
		/**
		 * @acces public.
		 * @return String.
		 */
		public static function getDefaultController() {
			return 'home';
		}
	}

?>