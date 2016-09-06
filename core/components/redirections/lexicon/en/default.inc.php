<?php

	/**
	 * Redirections
	 *
	 * Copyright 2016 by Oene Tjeerd de Bruin <info@oetzie.nl>
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

	$_lang['redirections'] 											= 'Redirects';
	$_lang['redirections.desc'] 									= 'Change or create site-wide redirects';
	
	$_lang['area_redirections'] 									= 'Redirects';
	
	$_lang['redirections.redirect']									= 'Redirect';
	$_lang['redirections.redirects']								= 'Redirects';
	$_lang['redirections.redirects_desc']							= 'Here you can set redirects for the MODX site. A redirect is meant to redirect an old page to the new location, for example links that locate to your site from other sites. Dead links, especially those from Google, are bad for your SEO. For a wildcard in the old URL use % (you can pass the wildcard to the new URL with $NUMBER_WILDCARD), use ^ to start an URL range (ex. ^nieuws) or use $ to end an URL range (ex. news$). As new URL can you use [[~ID]] or a textual URL.';
	$_lang['redirections.redirect_create']							= 'Create new redirect';
	$_lang['redirections.redirect_update']							= 'Update redirect';
	$_lang['redirections.redirect_remove']							= 'Delete redirect';
	$_lang['redirections.redirect_remove_confirm']					= 'Are you sure you want to delete this redirect? This can be bad for your SEO.';
	$_lang['redirections.redirect_remove_selected']					= 'Delete selected redirects';
	$_lang['redirections.redirect_remove_selected_confirm']			= 'Are you sure you want to delete the selected redirects?';
	$_lang['redirections.redirect_activate_selected']				= 'Activate selected redirects';
	$_lang['redirections.redirect_activate_selected_confirm']		= 'Are you sure you want to activate the selected redirects?';
	$_lang['redirections.redirect_deactivate_selected']				= 'Deactivate selected redirects';
	$_lang['redirections.redirect_deactivate_selected_confirm']		= 'Are you sure you want to deactivate the selected redirects?';
	
	$_lang['redirections.label_old']								= 'Old URL';
	$_lang['redirections.label_old_desc']							= 'The old URL of the redirect.';
	$_lang['redirections.label_new']								= 'new URL';
	$_lang['redirections.label_new_desc']							= 'The new URL of the redirect to redirect to.';
	$_lang['redirections.label_context']							= 'Context';
	$_lang['redirections.label_context_desc']						= 'The context of the redirect.';
	$_lang['redirections.label_type']								= 'Redirect type';
	$_lang['redirections.label_type_desc']							= 'The type of the redirect.';
	$_lang['redirections.label_active']								= 'Active';
	$_lang['redirections.label_active_desc']						= '';
	
	$_lang['redirections.filter_context']							= 'Filter on context...';
	$_lang['redirections.activate_selected']						= 'Activate selected';
	$_lang['redirections.deactivate_selected']						= 'Deactivate selected';
	$_lang['redirections.remove_selected']							= 'Delete selected';
	
?>