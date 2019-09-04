<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

abstract class RedirectionsManagerController extends modExtraManagerController
{
    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('redirections', 'Redirections', $this->modx->getOption('redirections.core_path', null, $this->modx->getOption('core_path') . 'components/redirections/') . 'model/redirections/');

        $this->addCss($this->modx->redirections->config['css_url'] . 'mgr/redirections.css');

        $this->addJavascript($this->modx->redirections->config['js_url'] . 'mgr/redirections.js');

        $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                MODx.config.help_url = "' . $this->modx->redirections->getHelpUrl() . '";
                
                Redirections.config = ' . $this->modx->toJSON(array_merge($this->modx->redirections->config, [
                    'branding_url'          => $this->modx->redirections->getBrandingUrl(),
                    'branding_url_help'     => $this->modx->redirections->getHelpUrl()
                ])) . ';
            });
        </script>');

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getLanguageTopics()
    {
        return $this->modx->redirections->config['lexicons'];
    }

    /**
     * @access public.
     * @returns Boolean.
     */
    public function checkPermissions()
    {
        return $this->modx->hasPermission('redirections');
    }
}

class IndexManagerController extends RedirectionsManagerController
{
    /**
     * @access public.
     * @return String.
     */
    public static function getDefaultController()
    {
        return 'home';
    }
}
