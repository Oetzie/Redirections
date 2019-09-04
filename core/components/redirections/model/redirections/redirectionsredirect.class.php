<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

class RedirectionsRedirect extends xPDOSimpleObject
{
    /**
     * @access public.
     * @return String.
     */
    public function getSiteUrl()
    {
        $setting = $this->xpdo->getObject('modContextSetting', [
            'context_key'   => $this->get('context'),
            'key'           => 'site_url'
        ]);

        if ($setting) {
            return rtrim($setting->get('value'), '/') . '/';
        }

        return rtrim($this->xpdo->getOption('site_url'), '/') . '/';
    }
}
