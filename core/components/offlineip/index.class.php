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

	abstract class OfflineIpManagerController extends modExtraManagerController {
		/**
		 * @acces public.
		 * @var Object.
		 */
		public $offlineIp;
		
		/**
		 * @acces public.
		 * @return Mixed.
		 */
		public function initialize() {
			require_once $this->modx->getOption('offlineip.core_path', null, $this->modx->getOption('core_path').'components/offlineip/').'/model/offlineip/offlineip.class.php';
			
			$this->offlineIp = new OfflineIp($this->modx);
			
			$this->addJavascript($this->offlineIp->config['jsUrl'].'mgr/offlineip.js');
			$this->addHtml('<script type="text/javascript">
				Ext.onReady(function() {
					MODx.config.help_url = "http://rtfm.modx.com/extras/revo/'.$this->offlineIp->getHelpUrl().'";
			
					OfflineIp.config = '.$this->modx->toJSON(array_merge(array('remoteip' => $_SERVER['REMOTE_ADDR']), $this->offlineIp->config)).';
				});
			</script>');
			
			return parent::initialize();
		}
		
		/**
		 * @acces public.
		 * @return Array.
		 */
		public function getLanguageTopics() {
			return array('offlineip:default');
		}
		
		/**
		 * @acces public.
		 * @returns Boolean.
		 */	    
		public function checkPermissions() {
			return true;
		}
	}
		
	class IndexManagerController extends OfflineIpManagerController {
		/**
		 * @acces public.
		 * @return String.
		 */
		public static function getDefaultController() {
			return 'home';
		}
	}

?>