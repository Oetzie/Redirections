<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

$_lang['redirections']                                          = 'URL redirects';
$_lang['redirections.desc']                                     = 'Change or create URL redirects.';

$_lang['area_redirections']                                     = 'URL redirects';

$_lang['setting_redirections.branding_url']                     = 'Branding';
$_lang['setting_redirections.branding_url_desc']                = 'The URL of the branding button, if the URL is empty the branding button won\'t be shown.';
$_lang['setting_redirections.branding_url_help']                = 'Branding (help)';
$_lang['setting_redirections.branding_url_help_desc']           = 'The URL of the branding help button, if the URL is empty the branding help button won\'t be shown.';
$_lang['setting_redirections.files']                            = 'File extensions';
$_lang['setting_redirections.files_desc']                       = 'The file extensions to exclude the files from the error pages (404). Separate multiple file extensions with a comma.';
$_lang['setting_redirections.migrate']                          = 'Migration';
$_lang['setting_redirections.migrate_desc']                     = 'When \'Yes\', all the resource are migrated correctly.';
$_lang['setting_redirections.clean_days']                       = 'Clean up period';
$_lang['setting_redirections.clean_days_desc']                  = 'The clean up period, after this all old 404 pages will be removed. Default is \'30\'.';
$_lang['setting_redirections.log_send']                         = 'Send log';
$_lang['setting_redirections.log_send_desc']                    = 'When yes, send the log file that will be created by email.';
$_lang['setting_redirections.log_email']                        = 'Log e-mail address(es)';
$_lang['setting_redirections.log_email_desc']                   = 'The e-mail address(es) where the log file needs to be send. Separate e-mail addresses with a comma.';
$_lang['setting_redirections.log_lifetime']                     = 'Log lifetime';
$_lang['setting_redirections.log_lifetime_desc']                = 'The number of days that a log file needs to be saved, after this the log file will be deleted automatically.';
$_lang['setting_redirections.cronjob_hash']                     = 'Cronjob hash';
$_lang['setting_redirections.cronjob_hash_desc']                = 'The hash of the cronjob, this hash needs to be send as a parameter with the cronjob.';
$_lang['setting_redirections.exclude_contexts']                 = 'Exclude contexts';
$_lang['setting_redirections.exclude_contexts_desc']            = 'The contexts to exclude from \'URL redirects\', separate multiple contexts with a comma.';

$_lang['redirections.redirect']                                 = 'URL redirect';
$_lang['redirections.redirects']                                = 'URL redirects';
$_lang['redirections.redirects_desc']                           = 'Manage here all URL redirects. An URL is meant to redirect old pages to the new pages, for example links from other websites to your site.';
$_lang['redirections.redirect_create']                          = 'Create new URL redirect';
$_lang['redirections.redirect_update']                          = 'Update URL redirect';
$_lang['redirections.redirect_remove']                          = 'Delete URL redirect';
$_lang['redirections.redirect_remove_confirm']                  = 'Are you sure you want to delete this URL redirect? This can be bad for your SEO.';
$_lang['redirections.redirects_reset']                          = 'Delete all URL redirects';
$_lang['redirections.redirects_reset_confirm']                  = 'Are you sure you want to delete all URL redirects?';

$_lang['redirections.error']                                    = '404 page';
$_lang['redirections.errors']                                   = '404 pages';
$_lang['redirections.errors_desc']                              = 'Manage here all your 404 pages. A 404 page is automatically detected and means that a link to a page no longer exists. A link that reaches the 404 page, especially that of Google, is bad for your SEO. For these 404 pages you must create an URL redirect.';
$_lang['redirections.error_create']                             = 'Create new URL redirect';
$_lang['redirections.error_remove']                             = 'Delete 404 page';
$_lang['redirections.error_remove_confirm']                     = 'Are you sure you want to delete this 404 page? This can be bad for your SEO.';
$_lang['redirections.errors_clean']                             = 'Clean 404 pages';
$_lang['redirections.errors_clean_confirm']                     = 'Are you sure you want to clean up all 404 pages?';
$_lang['redirections.errors_reset']                             = 'Delete all 40 pages';
$_lang['redirections.errors_reset_confirm']                     = 'Are you sure you want to delete all 404 pages?';

$_lang['redirections.label_old_url']                            = 'Old URL';
$_lang['redirections.label_old_url_desc']                       = 'The old URL of the redirect (without host). For a wildcard use % (you can pass the wildcard to the new URL with $1), use ^ to start an URL range (ex. ^news) or use $ to end an URL range (ex. news$).';
$_lang['redirections.label_new_url']                            = 'New URL';
$_lang['redirections.label_new_url_desc']                       = 'The new URL of the redirect to redirect to (without host). This can be an ID of a resource.';
$_lang['redirections.label_context']                            = 'Context';
$_lang['redirections.label_context_desc']                       = 'The context of the redirect. If there is no context selected the redirect will be valid on all contexts.';
$_lang['redirections.label_redirect_type']                      = 'Redirect type';
$_lang['redirections.label_redirect_type_desc']                 = 'The type of the redirect.';
$_lang['redirections.label_active']                             = 'Active';
$_lang['redirections.label_active_desc']                        = '';
$_lang['redirections.label_visits']                             = 'Hits';
$_lang['redirections.label_visits_desc']                        = '';
$_lang['redirections.label_last_visit']                         = 'Latest hit';
$_lang['redirections.label_last_visit_desc']                    = '';

$_lang['redirections.label_clean_label']                        = 'Delete 404 pages older then';
$_lang['redirections.label_clean_desc']                         = 'days.';

$_lang['redirections.filter_context']                           = 'Filter on context...';
$_lang['redirections.filter_files']                             = 'Show files';
$_lang['redirections.errors_clean_desc']                        = 'This function makes it possible to delete 404 pages that have not been visited since the specified number of days. This promotion cannot be reversed!';
$_lang['redirections.errors_clean_executing']                   = 'Busy with cleaning up 404 pages';
$_lang['redirections.errors_clean_success']                     = '[[+amount]] 404 pages removed.';
$_lang['redirections.migrate_redirections']                     = 'Migrate existing pages';
$_lang['redirections.migrate_redirections_confirm']             = 'Are you sure you want to migrate all existing pages?';
$_lang['redirections.migrate_redirections_success']             = '[[+amount]] pages migrated.';
