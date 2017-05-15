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

	class RedirectionsRedirectsGetListProcessor extends modObjectGetListProcessor {
		/**
		 * @access public.
		 * @var String.
		 */
		public $classKey = 'RedirectionsRedirects';
		
		/**
		 * @access public.
		 * @var Array.
		 */
		public $languageTopics = array('redirections:default');
		
		/**
		 * @access public.
		 * @var String.
		 */
		public $defaultSortField = 'old';
		
		/**
		 * @access public.
		 * @var String.
		 */
		public $defaultSortDirection = 'ASC';
		
		/**
		 * @access public.
		 * @var String.
		 */
		public $objectType = 'redirections.redirects';
		
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

			$this->setDefaultProperties(array(
				'dateFormat' => $this->modx->getOption('manager_date_format') .', '. $this->modx->getOption('manager_time_format')
			));
			
			return parent::initialize();
		}
		
		/**
		 * @access public.
		 * @param Object $c.
		 * @return Object.
		 */
		public function prepareQueryBeforeCount(xPDOQuery $c) {
			$c->where(array(
				'context' => $this->getProperty('context')
			));
					
			$query = $this->getProperty('query');
			
			if (!empty($query)) {
				$c->where(array(
					'old:LIKE' 		=> '%'.$query.'%',
					'OR:new:LIKE' 	=> '%'.$query.'%'
				));
			}
			
			return $c;
		}
		
		/**
		 * @acces public.
		 * @param Object $object.
		 * @return Array.
		 */
		public function prepareRow(xPDOObject $object) {
			$array = $object->toArray();

			if (in_array($array['editedon'], array('-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null))) {
				$array['editedon'] = '';
			} else {
				$array['editedon'] = date($this->getProperty('dateFormat'), strtotime($array['editedon']));
			}
			
			return $array;	
		}
	}

	return 'RedirectionsRedirectsGetListProcessor';
	
?>