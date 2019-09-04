<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

class RedirectionsRedirectUpdateProcessor extends modObjectUpdateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'RedirectionsRedirect';

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['redirections:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'redirections.redirect';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('redirections', 'Redirections', $this->modx->getOption('redirections.core_path', null, $this->modx->getOption('core_path') . 'components/redirections/') . 'model/redirections/');

        if ($this->getProperty('active') === null) {
            $this->setProperty('active', 0);
        }

        return parent::initialize();
    }
}

return 'RedirectionsRedirectUpdateProcessor';
