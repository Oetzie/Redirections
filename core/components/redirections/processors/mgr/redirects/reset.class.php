<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

class RedirectionsRedirectsResetProcessor extends modObjectProcessor
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

        $this->setDefaultProperties([
            'type' => 'redirect'
        ]);

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function process()
    {
        if ($this->getProperty('type') === 'error') {
            $this->modx->removeCollection($this->classKey, [
                'context:IN'    => [$this->getProperty('context'), ''],
                'active'        => 2
            ]);
        } else {
            $this->modx->removeCollection($this->classKey, [
                'context:IN'    => [$this->getProperty('context'), ''],
                'active:!='     => 2
            ]);
        }

        return $this->outputArray([]);
    }
}

return 'RedirectionsRedirectsResetProcessor';
