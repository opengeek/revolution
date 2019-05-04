<?php
/*
 * This file is part of MODX Revolution.
 *
 * Copyright (c) MODX, LLC. All Rights Reserved.
 *
 * For complete copyright and license information, see the COPYRIGHT and LICENSE
 * files found in the top-level directory of this distribution.
 */

namespace MODX\Revolution\Processors\Security\Forms\Set;

use MODX\Revolution\modFormCustomizationSet;
use MODX\Revolution\modObjectUpdateProcessor;

/**
 * Deactivate a FC Set
 * @package MODX\Revolution\Processors\Security\Forms\Set
 */
class Deactivate extends modObjectUpdateProcessor
{
    public $classKey = modFormCustomizationSet::class;
    public $objectType = 'set';
    public $languageTopics = ['formcustomization'];
    public $permission = 'customize_forms';

    /**
     * @return bool
     */
    public function beforeSet()
    {
        $this->unsetProperty('action');
        return parent::beforeSet();
    }

    /**
     * @return bool
     */
    public function beforeSave()
    {
        $this->object->set('active', false);
        return parent::beforeSave();
    }
}
