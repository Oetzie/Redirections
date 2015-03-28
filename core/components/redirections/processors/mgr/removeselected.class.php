<?php

	/**
	 * Newsletter
	 *
	 * Copyright 2014 by Oene Tjeerd de Bruin <info@oetzie.nl>
	 *
	 * This file is part of Newsletter, a real estate property listings component
	 * for MODX Revolution.
	 *
	 * Newsletter is free software; you can redistribute it and/or modify it under
	 * the terms of the GNU General Public License as published by the Free Software
	 * Foundation; either version 2 of the License, or (at your option) any later
	 * version.
	 *
	 * Newsletter is distributed in the hope that it will be useful, but WITHOUT ANY
	 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
	 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License along with
	 * Newsletter; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
	 * Suite 330, Boston, MA 02111-1307 USA
	 */

	class RedirectsRemoveSelectedProcessor extends modProcessor {
		/**
		 * @acces public.
		 * @var String.
		 */
		public $classKey = 'RedirectionsRedirects';
		
		/**
		 * @acces public.
		 * @var Array.
		 */
		public $languageTopics = array('redirections:default');
		
		/**
		 * @acces public.
		 * @var String.
		 */
		public $objectType = 'redirections.redirects';
		
		/**
		 * @acces public.
		 * @return Mixed.
		 */
		public function process() {
			foreach (explode(',', $this->getProperty('ids')) as $key => $value) {
				$criteria = array('id' => $value);
				
				if (false !== ($object = $this->modx->getObject($this->classKey, $criteria))) {
					$object->remove();
				}
			}
			
			return $this->outputArray(array());
		}
	}

	return 'RedirectsRemoveSelectedProcessor';

?>