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

	$_lang['offlineip'] 											= 'IP uitzonderingen';
	$_lang['offlineip.desc'] 										= 'Wijzig of maak site-brede IP uitzonderingen voor offline gebruik.';
	
	$_lang['area_offlineip']										= 'IP uitzonderingen';
	
	$_lang['offlineip.exception']									= 'Uitzondering';
	$_lang['offlineip.exceptions']									= 'Uitzonderingen';
	$_lang['offlineip.exceptions_desc']								= 'Hier kun je alle IP uitzonderingen instellen voor jouw MODX website. Een IP uitzondering is bedoelt om iemand aan de hand van zijn of haar IP nummer toegang tot de website te verlenen indien de website status op offline staat. Voor een wildcard in het IP nummer gebruik %, gebruik een ^ om een IP reeks te starten (bv ^172.0.) of gebruik $ om een IP reeks te eindigen (bv .0.1$).';
	$_lang['offlineip.exception_create']							= 'Maak nieuwe uitzondering';
	$_lang['offlineip.exception_update']							= 'Uitzondering updaten';
	$_lang['offlineip.exception_remove']							= 'Uitzondering verwijderen';
	$_lang['offlineip.exception_remove_confirm']					= 'Weet je zeker dat je deze uitzondering wilt verwijderen?';
	$_lang['offlineip.exception_remove_selected']					= 'Geselecteerde uitzonderingen verwijderen';
	$_lang['offlineip.exception_remove_selected_confirm']			= 'Weet je zeker dat je de geselecteerde uitzonderingen wilt verwijderen?';
	$_lang['offlineip.exception_activate_selected']					= 'Geselecteerde uitzonderingen activeren';
	$_lang['offlineip.exception_activate_selected_confirm']			= 'Weet je zeker dat je de geselecteerde uitzonderingen wilt activeren?';
	$_lang['offlineip.exception_deactivate_selected']				= 'Geselecteerde uitzonderingen deactiveren';
	$_lang['offlineip.exception_deactivate_selected_confirm']		= 'Weet je zeker dat je de geselecteerde uitzonderingen wilt deactiveren?';
	
	$_lang['offlineip.label_ipnumber']								= 'IP nummer';
	$_lang['offlineip.label_ipnumber_desc']							= 'Het IP nummer wat toegang tot de website heeft.';
	$_lang['offlineip.label_own_ipnumber']							= 'Mijn IP';
	$_lang['offlineip.label_name']									= 'Naam';
	$_lang['offlineip.label_name_desc']								= 'De naam van de uitzondering.';
	$_lang['offlineip.label_context']								= 'Context';
	$_lang['offlineip.label_context_desc']							= 'De context van de uitzondering.';
	$_lang['offlineip.label_description']							= 'Omschrijving';
	$_lang['offlineip.label_description_desc']						= 'De omschrijving van de uitzondering.';
	$_lang['offlineip.label_active']								= 'Actief';
	$_lang['offlineip.label_active_desc']							= '';
	
	$_lang['offlineip.filter_context']								= 'Filter op context...';
	$_lang['offlineip.activate_selected']							= 'Activeer geselecteerden';
	$_lang['offlineip.deactivate_selected']							= 'Deactiveer geselecteerden';
	$_lang['offlineip.remove_selected']								= 'Verwijder geselecteerden';
	
?>