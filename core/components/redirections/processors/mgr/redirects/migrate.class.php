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

	class RedirectionsRedirectsMigrateProcessor extends modProcessor {
		/**
		 * @access public.
		 * @var Array.
		 */
		public $languageTopics = array('redirections:default');
		
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

			return parent::initialize();
		}
		
		/**
		 * @access public.
		 * @return Mixed.
		 */
		public function process() {
			$c = array(
				'key:!=' => 'mgr'
			);
			
			foreach ($this->modx->getCollection('modContext', $c) as $context) {
				$c = array(
					'context_key' => $context->key
				);
				
				foreach ($this->modx->getCollection('modResource', $c) as $resource) {
					$properties = $resource->getProperties('redirections');
					
					if (!isset($properties['url'])) {
						$resource->setProperties(array_merge($properties, array(
							'uri' => trim($resource->get('uri'), '/')
						)), 'redirections');
					}
					
					$resource->save();
				}
			}
			
			if (null !== ($setting = $this->modx->getObject('modSystemSetting', 'redirections.migrate'))) {
				$setting->fromArray(array(
					'value' => 1
				));
				
				if ($setting->save()) {
					$this->modx->cacheManager->refresh(array(
						'system_settings' => array()
					));
				}
			}
			
			return $this->success('', array());
		}
	}

	return 'RedirectionsRedirectsMigrateProcessor';
	
?>