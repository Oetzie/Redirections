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

	$_lang['redirections']                                          = 'URL redirects';
	$_lang['redirections.desc']                                     = 'Change or create URL redirects.';
	
	$_lang['area_redirections']                                     = 'URL redirects';
	
	$_lang['setting_redirections.branding_url']                     = 'Branding';
    $_lang['setting_redirections.branding_url_desc']                = 'The URL of the branding button, if the URL is empty the branding button won\'t be shown.';
    $_lang['setting_redirections.branding_url_help']                = 'Branding (help)';
    $_lang['setting_redirections.branding_url_help_desc']           = 'The URL of the branding help button, if the URL is empty the branding help button won\'t be shown.';
	$_lang['setting_redirections.migrate']                          = 'Migrate';
    $_lang['setting_redirections.migrate_desc']                     = '';
    $_lang['setting_redirections.files']                            = 'File extensions';
    $_lang['setting_redirections.files_desc']                       = 'The file extensions to exclude the files from the error pages (404). Separate multiple file extensions with a comma.';
    
	$_lang['redirections.redirect']                                 = 'URL redirect';
	$_lang['redirections.redirects']                                = 'URL redirects';
	$_lang['redirections.redirects_desc']                           = 'Manage here all URL redirects. An URL is meant to redirect old pages to the new pages, for example links from other websites to your site.';
	$_lang['redirections.redirect_create']                          = 'Create new URL redirect';
	$_lang['redirections.redirect_update']                          = 'Update URL redirect';
	$_lang['redirections.redirect_remove']                          = 'Delete URL redirect';
	$_lang['redirections.redirect_remove_confirm']                  = 'Are you sure you want to delete this URL redirect? This can be bad for your SEO.';
	$_lang['redirections.redirects_reset']                          = 'Delete all URL redirects';
	$_lang['redirections.redirects_reset_confirm']                  = 'Are you sure you want to delete all URL redirects?';
	
	$_lang['redirections.error']                                    = 'Error page (404)';
	$_lang['redirections.errors']                                   = 'Error pages (404)';
	$_lang['redirections.errors_desc']                              = 'Manage here all your error pages. An error page, also know as 404 page, does mean that a link to a page does not exists (anymore). A link that comes out at the page 404, especially those from Google, are bad for your SEO.';
	$_lang['redirections.error_create']                             = 'Create new URL redirect';
	$_lang['redirections.error_remove']                             = 'Delete error page (404)';
	$_lang['redirections.error_remove_confirm']                     = 'Are you sure you want to delete this error page (404)? This can be bad for your SEO.';
	$_lang['redirections.errors_reset']                             = 'Delete all error pages (404)';
	$_lang['redirections.errors_reset_confirm']                     = 'Are you sure you want to delete all error pages (404)?';
	
	$_lang['redirections.label_old']                                = 'Old URL';
	$_lang['redirections.label_old_desc']                           = 'The old URL of the redirect (without host). For a wildcard use % (you can pass the wildcard to the new URL with $1), use ^ to start an URL range (ex. ^news) or use $ to end an URL range (ex. news$).';
	$_lang['redirections.label_new']                                = 'new URL';
	$_lang['redirections.label_new_desc']                           = 'The new URL of the redirect to redirect to (without host). This can be an ID of a resource.';
	$_lang['redirections.label_context']                            = 'Context';
	$_lang['redirections.label_context_desc']                       = 'The context of the redirect. If there is no context selected the redirect will be valid on all contexts.';
	$_lang['redirections.label_type']                               = 'Redirect type';
	$_lang['redirections.label_type_desc']                          = 'The type of the redirect.';
	$_lang['redirections.label_active']                             = 'Active';
	$_lang['redirections.label_active_desc']                        = '';
	
	$_lang['redirections.filter_context']                           = 'Filter on context...';
	$_lang['redirections.migrate_redirections']                     = 'URLs migreren';
	$_lang['redirections.migrate_redirections_confirm']             = 'Weet je zeker dat je alle URLs wilt migreren?';
	$_lang['redirections.migrate_redirections_success']             = 'Succes!';
	$_lang['redirections.migrate_redirections_success_desc']        = 'De URLs zijn succesvol gemigreerd.';
	
?>