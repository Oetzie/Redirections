<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

$_lang['redirections']                                          = 'URL verwijzingen';
$_lang['redirections.desc']                                     = 'Wijzig of maak URL verwijzingen.';

$_lang['area_redirections']                                     = 'URL verwijzingen';

$_lang['setting_redirections.branding_url']                     = 'Branding';
$_lang['setting_redirections.branding_url_desc']                = 'De URL waar de branding knop heen verwijst, indien leeg wordt de branding knop niet getoond.';
$_lang['setting_redirections.branding_url_help']                = 'Branding (help)';
$_lang['setting_redirections.branding_url_help_desc']           = 'De URL waar de branding help knop heen verwijst, indien leeg wordt de branding help knop niet getoond.';
$_lang['setting_redirections.files']                            = 'Bestandsextensies';
$_lang['setting_redirections.files_desc']                       = 'De extensies om de bestanden uit de foutpagina\'s (404) te filteren. Meerdere bestandsextensies scheiden met een komma.';
$_lang['setting_redirections.migrate']                          = 'Migratie';
$_lang['setting_redirections.migrate_desc']                     = 'Indien \'Ja\', dan zijn alle pagina\'s goed gemigreerd.';
$_lang['setting_redirections.clean_days']                       = 'Opruim periode';
$_lang['setting_redirections.clean_days_desc']                  = 'Het aantal dagen waarna oude 404 pagina\'s verwijderd worden. Standaard is \'30\'.';
$_lang['setting_redirections.log_send']                         = 'Log versturen';
$_lang['setting_redirections.log_send_desc']                    = 'Indien ja, het aangemaakte log bestand die automatisch word aangemaakt versturen via e-mail.';
$_lang['setting_redirections.log_email']                        = 'Log e-mailadres(sen)';
$_lang['setting_redirections.log_email_desc']                   = 'De e-mailadres(sen) waar het log bestand heen gestuurd dient te worden. Meerdere e-mailadressen scheiden met een komma.';
$_lang['setting_redirections.log_lifetime']                     = 'Log levensduur';
$_lang['setting_redirections.log_lifetime_desc']                = 'Het aantal dagen dat een log bestand bewaard moet blijven, hierna word het log bestand automatisch verwijderd.';
$_lang['setting_redirections.cronjob_hash']                     = 'Cronjob hash';
$_lang['setting_redirections.cronjob_hash_desc']                = 'De hash van de cronjob, deze hash dient als parameter mee gegeven te worden met de cronjob.';
$_lang['setting_redirections.exclude_contexts']                 = 'Contexten uitsluiten';
$_lang['setting_redirections.exclude_contexts_desc']            = 'De contexten die uitgesloten zijn voor \'URL verwijzigen\', meerdere contexten scheiden met een komma.';

$_lang['redirections.redirect']                                 = 'URL verwijzing';
$_lang['redirections.redirects']                                = 'URL verwijzingen';
$_lang['redirections.redirects_desc']                           = 'Beheer hier alle URL verwijzingen. Een URL verwijzing is bedoelt om oude pagina\'s naar de nieuwe pagina\'s te door te wijzen, bijvoorbeeld links vanuit een andere websites naar jouw website.';
$_lang['redirections.redirect_create']                          = 'Nieuwe URL verwijzing';
$_lang['redirections.redirect_update']                          = 'URL verwijzing wijzigen';
$_lang['redirections.redirect_remove']                          = 'URL verwijzing verwijderen';
$_lang['redirections.redirect_remove_confirm']                  = 'Weet je zeker dat je deze URL verwijzing wilt verwijderen? Dit kan een slecht invloed hebben voor de SEO.';
$_lang['redirections.redirects_reset']                          = 'Alle URL verwijzingen verwijderen';
$_lang['redirections.redirects_reset_confirm']                  = 'Weet je zeker dat je alle URL verwijzingen wilt verwijderen?';

$_lang['redirections.error']                                    = '404 pagina';
$_lang['redirections.errors']                                   = '404 pagina\'s';
$_lang['redirections.errors_desc']                              = 'Bekijk hier hier alle 404 pagina\'s. Een 404 pagina word automatisch gedetecteerd en betekend dat een link naar een pagina niet (meer) bestaat. Een link die bij de 404 pagina uitkomt, vooral die van Google, is slecht voor je SEO. Voor deze 404 pagina\'s dien je dus een URL verwijzing te maken.';
$_lang['redirections.error_create']                             = 'Nieuwe URL verwijzing';
$_lang['redirections.error_remove']                             = '404 pagina verwijderen';
$_lang['redirections.error_remove_confirm']                     = 'Weet je zeker dat je deze 404 pagina wilt verwijderen? Dit kan een slecht invloed hebben voor de SEO.';
$_lang['redirections.errors_clean']                             = '404 pagina\'s opruimen';
$_lang['redirections.errors_clean_confirm']                     = 'Weet je zeker dat je alle 404 pagina\'s wilt opruimen?';
$_lang['redirections.errors_reset']                             = 'Alle 404 pagina\'s verwijderen';
$_lang['redirections.errors_reset_confirm']                     = 'Weet je zeker dat je alle 404 pagina\'s wilt verwijderen?';

$_lang['redirections.label_old_url']                            = 'Oude URL';
$_lang['redirections.label_old_url_desc']                       = 'De oude URL van de verwijzing (zonder host). Voor een wildcard gebruik % (deze wildcard kun je door geven aan de nieuwe URL met $1), gebruik een ^ om een URL reeks te starten (bv ^nieuws) of gebruik $ om een URL reeks te eindigen (bv nieuws$). ';
$_lang['redirections.label_new_url']                            = 'Nieuwe URL';
$_lang['redirections.label_new_url_desc']                       = 'De nieuwe URL waar de verwijzing heen moet verwijzen (zonder host). Dit kan ook een ID van een pagina zijn.';
$_lang['redirections.label_context']                            = 'Context';
$_lang['redirections.label_context_desc']                       = 'De context van de verwijzing. Als er geen context geselecteerd word geldt deze verwijzing voor alle contexten.';
$_lang['redirections.label_redirect_type']                      = 'Verwijzingstype';
$_lang['redirections.label_redirect_type_desc']                 = 'De type van de verwijzing.';
$_lang['redirections.label_active']                             = 'Actief';
$_lang['redirections.label_active_desc']                        = '';
$_lang['redirections.label_visits']                             = 'Hits';
$_lang['redirections.label_visits_desc']                        = '';
$_lang['redirections.label_last_visit']                         = 'Laatste hit';
$_lang['redirections.label_last_visit_desc']                    = '';

$_lang['redirections.label_clean_label']                        = 'Verwijder 404 pagina\'s ouder dan';
$_lang['redirections.label_clean_desc']                         = 'dagen.';

$_lang['redirections.filter_context']                           = 'Filter op context...';
$_lang['redirections.filter_files']                             = 'Bestanden tonen';
$_lang['redirections.errors_clean_desc']                        = 'Deze functie maakt het mogelijk om 404 pagina\'s, die niet meer bezocht zijn sinds het opgegeven aantal dagen, te verwijderen. Deze actie kan niet worden teruggedraaid!';
$_lang['redirections.errors_clean_executing']                   = 'Bezig met opruimen van 404 pagina\'s';
$_lang['redirections.errors_clean_success']                     = '[[+amount]] 404 pagina(\'s) verwijderd.';
$_lang['redirections.migrate_redirections']                     = 'Bestaande pagina\'s migreren';
$_lang['redirections.migrate_redirections_confirm']             = 'Weet je zeker dat je alle bestaande pagina\'s wilt migreren?';
$_lang['redirections.migrate_redirections_success']             = '[[+amount]] pagina\'s gemigreerd.';
