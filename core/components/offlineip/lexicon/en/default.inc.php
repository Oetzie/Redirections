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

	$_lang['offlineip'] 											= 'IP exception';
	$_lang['offlineip.desc'] 										= 'Change or create site-wide IP exceptions for offline use.';
	
	$_lang['area_offlineip'] 										= 'IP exception';
			
	$_lang['offlineip.exception']									= 'Exception';
	$_lang['offlineip.exceptions']									= 'Exceptions';
	$_lang['offlineip.exceptions_desc']								= 'Here you can set IP exceptions for the MODX site. A IP exception is meant to give some one with use of his or her IP number acces to the website if the site status is offline. For a wildcard in the IP number use %, use ^ to start an IP range (ex. ^127.0.) or use $ to end an IP range (ex. .0.1$).';
	$_lang['offlineip.exception_create']							= 'Create new exception';
	$_lang['offlineip.exception_update']							= 'Update exception.';
	$_lang['offlineip.exception_remove']							= 'Delete exception';
	$_lang['offlineip.exception_remove_confirm']					= 'Are you sure you want to delete this exception?';
	$_lang['offlineip.exception_remove_selected']					= 'Delete selected subscriptions';
	$_lang['offlineip.exception_remove_selected_confirm']			= 'Are you sure you want to delete the selected subscriptions?';
	$_lang['offlineip.exception_activate_selected']					= 'Activate selected subscriptions';
	$_lang['offlineip.exception_activate_selected_confirm']			= 'Are you sure you want to activate the selected subscriptions?';
	$_lang['offlineip.exception_deactivate_selected']				= 'Deactivate selected subscriptions';
	$_lang['offlineip.exception_deactivate_selected_confirm']		= 'Are you sure you want to deactivate the selected subscriptions?';
	
	$_lang['offlineip.label_ipnumber']								= 'IP number';
	$_lang['offlineip.label_ipnumber_desc']							= 'The IP number that has acces to the site.';
	$_lang['offlineip.label_own_ipnumber']							= 'My IP';
	$_lang['offlineip.label_name']									= 'Name';
	$_lang['offlineip.label_name_desc']								= 'The name of the exception.';
	$_lang['offlineip.label_context']								= 'Context';
	$_lang['offlineip.label_context_desc']							= 'The context of the exception.';
	$_lang['offlineip.label_description']							= 'Description';
	$_lang['offlineip.label_description_desc']						= 'The description of the exception.';
	$_lang['offlineip.label_active']								= 'Active';
	$_lang['offlineip.label_active_desc']							= '';
	
	$_lang['offlineip.filter_context']								= 'Filter on context...';
	$_lang['offlineip.activate_selected']							= 'Activate selected';
	$_lang['offlineip.deactivate_selected']							= 'Deactivate selected';
	$_lang['offlineip.remove_selected']								= 'Delete selected';
	
?>