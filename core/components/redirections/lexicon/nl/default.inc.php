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

	$_lang['redirections'] 											= 'Verwijzingen';
	$_lang['redirections.desc'] 									= 'Wijzig of maak verwijzingen.';
	
	$_lang['area_redirections']										= 'Verwijzingen';
	
	$_lang['redirections.redirect']									= 'Verwijzing';
	$_lang['redirections.redirects']								= 'Verwijzingen';
	$_lang['redirections.redirects_desc']							= 'Hier kun je alle verwijzingen beheren voor je website. Een verwijzing is bedoelt om oude pagina\'s naar de nieuwe pagina\'s te door te verwijzen, bijvoorbeeld oude links vanuit een andere websites naar jouw website. Een link die bij de 404 pagina uitkomt, vooral die van Google, is slecht voor je SEO. ';
	$_lang['redirections.redirect_create']							= 'Nieuwe verwijzing';
	$_lang['redirections.redirect_update']							= 'Verwijzing wijzigen';
	$_lang['redirections.redirect_remove']							= 'Verwijzing verwijderen';
	$_lang['redirections.redirect_remove_confirm']					= 'Weet je zeker dat je deze verwijzing wilt verwijderen? Dit kan slecht uitpakken voor je SEO.';
	$_lang['redirections.redirects_reset']							= 'Alle verwijzingen verwijderen';
	$_lang['redirections.redirects_reset_confirm']					= 'Weet je zeker dat je alle verwijzingen wilt verwijderen?';
	
	$_lang['redirections.label_old']								= 'Oude URL';
	$_lang['redirections.label_old_desc']							= 'De oude URL van de verwijzing. Voor een wildcard gebruik % (deze wildcard kun je door geven aan de nieuwe URL met $1), gebruik een ^ om een URL reeks te starten (bv ^nieuws) of gebruik $ om een URL reeks te eindigen (bv nieuws$). ';
	$_lang['redirections.label_new']								= 'Nieuwe URL';
	$_lang['redirections.label_new_desc']							= 'De nieuwe URL waar de verwijzing heen moet verwijzen. Dit kan ook een ID van een pagina zijn.';
	$_lang['redirections.label_context']							= 'Context';
	$_lang['redirections.label_context_desc']						= 'De context van de verwijzing. Als er geen context geselecteerd word geldt deze verwijzing voor alle contexten.';
	$_lang['redirections.label_type']								= 'Verwijzingstype';
	$_lang['redirections.label_type_desc']							= 'De type van de verwijzing.';
	$_lang['redirections.label_active']								= 'Actief';
	$_lang['redirections.label_active_desc']						= '';
	
	$_lang['redirections.filter_context']							= 'Filter op context...';
	
?>