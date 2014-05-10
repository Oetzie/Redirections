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

	$_lang['redirections'] 									= 'Verwijzingen';
	$_lang['redirections.desc'] 							= 'Wijzig of maak site-brede verwijzingen.';
	
	$_lang['area_redirections']								= 'Verwijzingen';
	
	$_lang['redirections.redirect']							= 'Verwijzing';
	$_lang['redirections.redirects']						= 'Verwijzingen';
	$_lang['redirections.redirects_desc']					= 'Hier kun je alle verwijzingen instellen voor jouw MODX website. Een verwijzing is bedoelt om een oude pagina naar de nieuwe locatie te verwijzen, bijvoorbeeld links die verwijzen vanuit andere sites naar jouw site. Dode links, vooral die van Google, zijn slecht voor je SEO. Voor een wildcard in de oude URL gebruik % (de wildcard kun je door geven aan de nieuwe URL met $NUMMER_WILDCARD), gebruik een ^ om een URL reeks te starten (bv ^nieuws) of gebruik $ om een URL reeks te eindigen (bv nieuws$). Als nieuwe URL kun je [[~ID]] of een tekstuele URL gebruiken.';
	$_lang['redirections.redirect_create']					= 'Maak nieuwe verwijzing';
	$_lang['redirections.redirect_update']					= 'Verwijzing updaten';
	$_lang['redirections.redirect_remove']					= 'Verwijzing verwijderen';
	$_lang['redirections.redirect_remove_confirm']			= 'Weet je zeker dat je deze verwijzing wilt verwijderen? Dit kan slecht uitpakken voor je SEO.';
	
	$_lang['redirections.label_old']						= 'Oude URL';
	$_lang['redirections.label_old_desc']					= 'De oude URL van de verwijzing.';
	$_lang['redirections.label_new']						= 'Nieuwe URL';
	$_lang['redirections.label_new_desc']					= 'De nieuwe URL waar de verwijzing heen moet verwijzen.';
	$_lang['redirections.label_context']					= 'Context';
	$_lang['redirections.label_context_desc']				= 'De context van de verwijzing.';
	$_lang['redirections.label_type']						= 'Verwijzings type';
	$_lang['redirections.label_type_desc']					= 'De type van de verwijzing.';
	$_lang['redirections.label_active']						= 'Actief';
	$_lang['redirections.label_active_desc']				= '';
	
	$_lang['redirections.filter_context']					= 'Filter op context...';
	
?>