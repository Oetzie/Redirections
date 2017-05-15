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

	$_lang['redirections'] 											= 'Redirects';
	$_lang['redirections.desc'] 									= 'Change or create redirects';
	
	$_lang['area_redirections'] 									= 'Redirects';
	
	$_lang['redirections.redirect']									= 'Redirect';
	$_lang['redirections.redirects']								= 'Redirects';
	$_lang['redirections.redirects_desc']							= 'Here you can set redirects for your site. A redirect is meant to redirect old resources to the new redirections, for example links from other websites to your site. A link that comes out at the page 404, especially those from Google, are bad for your SEO.';
	$_lang['redirections.redirect_create']							= 'Create new redirect';
	$_lang['redirections.redirect_update']							= 'Update redirect';
	$_lang['redirections.redirect_remove']							= 'Delete redirect';
	$_lang['redirections.redirect_remove_confirm']					= 'Are you sure you want to delete this redirect? This can be bad for your SEO.';
	$_lang['redirections.redirects_reset']							= 'Delete all redirects';
	$_lang['redirections.redirects_reset_confirm']					= 'Are you sure you want to delete all redirects?';
	
	$_lang['redirections.label_old']								= 'Old URL';
	$_lang['redirections.label_old_desc']							= 'The old URL of the redirect. For a wildcard use % (you can pass the wildcard to the new URL with $1), use ^ to start an URL range (ex. ^news) or use $ to end an URL range (ex. news$).';
	$_lang['redirections.label_new']								= 'new URL';
	$_lang['redirections.label_new_desc']							= 'The new URL of the redirect to redirect to. This can be an ID of a resource.';
	$_lang['redirections.label_context']							= 'Context';
	$_lang['redirections.label_context_desc']						= 'The context of the redirect. If there is no context selected the redirect will be valid on all contexts.';
	$_lang['redirections.label_type']								= 'Redirect type';
	$_lang['redirections.label_type_desc']							= 'The type of the redirect.';
	$_lang['redirections.label_active']								= 'Active';
	$_lang['redirections.label_active_desc']						= '';
	
	$_lang['redirections.filter_context']							= 'Filter on context...';
	
?>