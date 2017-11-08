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

	$_lang['redirections']                                          = 'URL verwijzingen';
	$_lang['redirections.desc']                                     = 'Wijzig of maak URL verwijzingen.';
	
	$_lang['area_redirections']                                     = 'URL verwijzingen';
	
	$_lang['setting_redirections.branding_url']                     = 'Branding';
	$_lang['setting_redirections.branding_url_desc']                = 'De URL waar de branding knop heen verwijst, indien leeg wordt de branding knop niet getoond.';
    $_lang['setting_redirections.branding_url_help']                = 'Branding (help)';
    $_lang['setting_redirections.branding_url_help_desc']           = 'De URL waar de branding help knop heen verwijst, indien leeg wordt de branding help knop niet getoond.';
    $_lang['setting_redirections.migrate']                          = 'Migratie';
    $_lang['setting_redirections.migrate_desc']                     = '';
    $_lang['setting_redirections.files']                            = 'Bestandsextensies';
    $_lang['setting_redirections.files_desc']                       = 'De extensies om de bestanden uit de foutpagina\'s (404) te filteren. Meerdere bestandsextensies scheiden met een komma.';
    
	$_lang['redirections.redirect']                                 = 'URL verwijzing';
	$_lang['redirections.redirects']                                = 'URL verwijzingen';
	$_lang['redirections.redirects_desc']                           = 'Beheer hier alle URL verwijzingen. Een URL verwijzing is bedoelt om oude pagina\'s naar de nieuwe pagina\'s te door te wijzen, bijvoorbeeld links vanuit een andere websites naar jouw website.';
	$_lang['redirections.redirect_create']                          = 'Nieuwe URL verwijzing';
	$_lang['redirections.redirect_update']                          = 'URL verwijzing wijzigen';
	$_lang['redirections.redirect_remove']                          = 'URL verwijzing verwijderen';
	$_lang['redirections.redirect_remove_confirm']                  = 'Weet je zeker dat je deze URL verwijzing wilt verwijderen? Dit kan een slecht invloed hebben voor de SEO.';
	$_lang['redirections.redirects_reset']                          = 'Alle URL verwijzingen verwijderen';
	$_lang['redirections.redirects_reset_confirm']                  = 'Weet je zeker dat je alle URL verwijzingen wilt verwijderen?';
	
	$_lang['redirections.error']                                    = 'Foutpagina (404)';
	$_lang['redirections.errors']                                   = 'Foutpagina\'s (404)';
	$_lang['redirections.errors_desc']                              = 'Beheer hier hier alle foutpagina\'s. Een foutpagina, oftewel 404 pagina, betekend dat een link naar een pagina niet (meer) bestaat. Een link die bij de foutpagina pagina uitkomt, vooral die van Google, is slecht voor je SEO.';
	$_lang['redirections.error_create']                             = 'Nieuwe URL verwijzing';
	$_lang['redirections.error_remove']                             = 'Foutpagina (404) verwijderen';
	$_lang['redirections.error_remove_confirm']                     = 'Weet je zeker dat je deze foutpagina wilt verwijderen? Dit kan een slecht invloed hebben voor de SEO.';
	$_lang['redirections.errors_reset']                             = 'Alle foutpagina\'s (404) verwijderen';
	$_lang['redirections.errors_reset_confirm']                     = 'Weet je zeker dat je alle foutpagina\'s (404) wilt verwijderen?';
	
	$_lang['redirections.label_old']                                = 'Oude URL';
	$_lang['redirections.label_old_desc']                           = 'De oude URL van de verwijzing (zonder host). Voor een wildcard gebruik % (deze wildcard kun je door geven aan de nieuwe URL met $1), gebruik een ^ om een URL reeks te starten (bv ^nieuws) of gebruik $ om een URL reeks te eindigen (bv nieuws$). ';
	$_lang['redirections.label_new']                                = 'Nieuwe URL';
	$_lang['redirections.label_new_desc']                           = 'De nieuwe URL waar de verwijzing heen moet verwijzen (zonder host). Dit kan ook een ID van een pagina zijn.';
	$_lang['redirections.label_context']                            = 'Context';
	$_lang['redirections.label_context_desc']                       = 'De context van de verwijzing. Als er geen context geselecteerd word geldt deze verwijzing voor alle contexten.';
	$_lang['redirections.label_type']                               = 'Verwijzingstype';
	$_lang['redirections.label_type_desc']                          = 'De type van de verwijzing.';
	$_lang['redirections.label_active']                             = 'Actief';
	$_lang['redirections.label_active_desc']                        = '';
	
	$_lang['redirections.filter_context']                           = 'Filter op context...';
	$_lang['redirections.filter_files']                             = 'Bestanden tonen';
	$_lang['redirections.migrate_redirections']                     = 'URLs migreren';
	$_lang['redirections.migrate_redirections_confirm']             = 'Weet je zeker dat je alle URLs wilt migreren?';
	$_lang['redirections.migrate_redirections_success']             = 'Succes!';
	$_lang['redirections.migrate_redirections_success_desc']        = 'De URLs zijn succesvol gemigreerd.';
	
?>