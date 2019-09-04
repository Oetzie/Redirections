<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

require_once dirname(__DIR__) . '/index.class.php';

class RedirectionsHomeManagerController extends RedirectionsManagerController
{
    /**
     * @access public.
     */
    public function loadCustomCssJs()
    {
        $this->addJavascript($this->modx->redirections->config['js_url'] . 'mgr/widgets/home.panel.js');

        $this->addJavascript($this->modx->redirections->config['js_url'] . 'mgr/widgets/redirects.grid.js');
        $this->addJavascript($this->modx->redirections->config['js_url'] . 'mgr/widgets/errors.grid.js');

        $this->addLastJavascript($this->modx->redirections->config['js_url'] . 'mgr/sections/home.js');
    }

    /**
     * @access public.
     * @return String.
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('redirections');
    }

    /**
    * @access public.
    * @return String.
    */
    public function getTemplateFile()
    {
        return $this->modx->redirections->config['templates_path'] . 'home.tpl';
    }
}
