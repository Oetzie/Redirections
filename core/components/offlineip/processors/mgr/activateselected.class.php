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

	class ExceptionsActivateSelectedProcessor extends modProcessor {
		/**
		 * @acces public.
		 * @var String.
		 */
		public $classKey = 'OfflineIpExceptions';
		
		/**
		 * @acces public.
		 * @var Array.
		 */
		public $languageTopics = array('offlineip:default');
		
		/**
		 * @acces public.
		 * @var String.
		 */
		public $objectType = 'offlineip.exceptions';
		
		/**
		 * @acces public.
		 * @return Mixed.
		 */
		public function process() {
			foreach (explode(',', $this->getProperty('ids')) as $key => $value) {
				$criteria = array('id' => $value);
				
				if (false !== ($object = $this->modx->getObject($this->classKey, $criteria))) {
					$object->fromArray(array(
						'active' => 'activate' == $this->getProperty('type') ? 1 : 0
					));
					$object->save();
				}
			}
			
			return $this->outputArray(array());
		}
	}

	return 'ExceptionsActivateSelectedProcessor';

?>