<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

class RedirectionsRedirectsGetListProcessor extends modObjectGetListProcessor
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
    public $defaultSortField = 'visits';

    /**
     * @access public.
     * @var String.
     */
    public $defaultSortDirection = 'ASC';

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
            'dateFormat'    => $this->modx->getOption('manager_date_format') . ', ' . $this->modx->getOption('manager_time_format'),
            'type'          => 'redirect',
            'files'         => 1
        ]);

        return parent::initialize();
    }

    /**
     * @access public.
     * @param xPDOQuery $criteria.
     * @return xPDOQuery.
     */
    public function prepareQueryBeforeCount(xPDOQuery $criteria)
    {
        $criteria->where([
            'context:IN' => [$this->getProperty('context'), '']
        ]);

        if ($this->getProperty('type') === 'error') {
            $criteria->where([
                'active' => 2
            ]);

            if ((int) $this->getProperty('files') === 1) {
                foreach (explode(',', $this->modx->getOption('redirections.files')) as $value) {
                    $criteria->where([
                        [
                            'AND:old_url:NOT LIKE' => '%.' . trim($value)
                        ]
                    ]);
                }
            }
        } else {
            $criteria->where([
                'active:!=' => 2
            ]);
        }

        $query = $this->getProperty('query');

        if (!empty($query)) {
            $criteria->where([
                'old_url:LIKE'      => '%' . $query . '%',
                'OR:new_url:LIKE'   => '%' . $query . '%'
            ]);
        }

        return $criteria;
    }

    /**
     * @access public.
     * @param xPDOObject $object.
     * @return Array.
     */
    public function prepareRow(xPDOObject $object)
    {
        $array = array_merge($object->toArray(), [
            'old_url_formatted' => $object->getSiteUrl() . ltrim($object->get('old_url'), '/'),
            'new_url_formatted' => ''
        ]);

        if (!preg_match('/^(http|https|www|ftp):/i', $object->get('new_url'))) {
            if (is_numeric($object->get('new_url'))) {
                $array['new_url_formatted'] = $object->getSiteUrl() . trim($this->modx->makeUrl($object->get('new_url')), '/');
            } else {
                $array['new_url_formatted'] = $object->getSiteUrl() . ltrim($object->get('new_url'), '/');
            }
        } else {
            $array['new_url_formatted'] = $object->get('new_url');
        }

        if (in_array($object->get('last_visit'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
            $array['last_visit'] = '';
        } else {
            $array['last_visit'] = date($this->getProperty('dateFormat'), strtotime($object->get('last_visit')));
        }

        if (in_array($object->get('editedon'), ['-001-11-30 00:00:00', '-1-11-30 00:00:00', '0000-00-00 00:00:00', null], true)) {
            $array['editedon'] = '';
        } else {
            $array['editedon'] = date($this->getProperty('dateFormat'), strtotime($object->get('editedon')));
        }

        return $array;
    }
}

return 'RedirectionsRedirectsGetListProcessor';
