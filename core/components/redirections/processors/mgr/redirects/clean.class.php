<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

class RedirectionsRedirectsCleanProcessor extends modObjectProcessor
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

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function process()
    {
        $amount = 0;

        $criteria = $this->modx->newQuery($this->classKey);

        $criteria->where([
            'context:IN'    => [$this->getProperty('context'), ''],
            'active'        => 2,
            'last_visit:<'  => date('Y-m-d', strtotime('-' . $this->getProperty('days', $this->modx->redirections->getOption('clean_days')) .' days'))
        ]);

        foreach ($this->modx->getCollection($this->classKey, $criteria) as $object) {
            if ($object->remove()) {
                $amount++;
            }
        }

        return $this->success($this->modx->lexicon('redirections.errors_clean_success', [
            'amount' => $amount
        ]));
    }
}

return 'RedirectionsRedirectsCleanProcessor';
