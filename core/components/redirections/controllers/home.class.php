<?php

	/**
	 * Redirections
	 *
	 * Copyright 2017 by Oene Tjeerd de Bruin <modx@oetzie.nl>
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
	 
    require_once dirname(dirname(__FILE__)).'/index.class.php';

	class RedirectionsHomeManagerController extends RedirectionsManagerController {
		/**
		 * @access public.
		 */
		public function loadCustomCssJs() {
			$this->addCss($this->redirections->config['css_url'].'mgr/redirections.css');
			
			$this->addJavascript($this->redirections->config['js_url'].'mgr/widgets/home.panel.js');
			
			$this->addJavascript($this->redirections->config['js_url'].'mgr/widgets/redirects.grid.js');
			$this->addJavascript($this->redirections->config['js_url'].'mgr/widgets/errors.grid.js');
			
			$this->addLastJavascript($this->redirections->config['js_url'].'mgr/sections/home.js');
		}
		
		/**
		 * @access public.
		 * @return String.
		 */
		public function getPageTitle() {
			return $this->modx->lexicon('redirections');
		}
		
		/**
		* @access public.
		* @return String.
		*/
		public function getTemplateFile() {
			return $this->redirections->config['templates_path'].'home.tpl';
		}
	}

?>