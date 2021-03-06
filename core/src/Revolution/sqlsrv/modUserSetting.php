<?php
namespace MODX\Revolution\sqlsrv;

use xPDO\xPDO;

class modUserSetting extends \MODX\Revolution\modUserSetting
{

    public static $metaMap = array (
        'package' => 'MODX\\Revolution\\',
        'version' => '3.0',
        'table' => 'user_settings',
        'extends' => 'xPDO\\Om\\xPDOObject',
        'fields' => 
        array (
            'user' => 0,
            'key' => '',
            'value' => NULL,
            'xtype' => 'textfield',
            'namespace' => 'core',
            'area' => '',
            'editedon' => NULL,
        ),
        'fieldMeta' => 
        array (
            'user' => 
            array (
                'dbtype' => 'int',
                'phptype' => 'integer',
                'null' => false,
                'default' => 0,
                'index' => 'pk',
            ),
            'key' => 
            array (
                'dbtype' => 'nvarchar',
                'precision' => '50',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
                'index' => 'pk',
            ),
            'value' => 
            array (
                'dbtype' => 'nvarchar',
                'precision' => 'max',
                'phptype' => 'string',
            ),
            'xtype' => 
            array (
                'dbtype' => 'nvarchar',
                'precision' => '75',
                'phptype' => 'string',
                'null' => false,
                'default' => 'textfield',
            ),
            'namespace' => 
            array (
                'dbtype' => 'nvarchar',
                'precision' => '40',
                'phptype' => 'string',
                'null' => false,
                'default' => 'core',
            ),
            'area' => 
            array (
                'dbtype' => 'nvarchar',
                'precision' => '255',
                'phptype' => 'string',
                'null' => false,
                'default' => '',
            ),
            'editedon' => 
            array (
                'dbtype' => 'datetime',
                'phptype' => 'timestamp',
                'null' => true,
            ),
        ),
        'indexes' => 
        array (
            'PRIMARY' => 
            array (
                'alias' => 'PRIMARY',
                'primary' => true,
                'unique' => true,
                'type' => 'BTREE',
                'columns' => 
                array (
                    'user' => 
                    array (
                        'length' => '',
                        'collation' => 'A',
                        'null' => false,
                    ),
                    'key' => 
                    array (
                        'length' => '',
                        'collation' => 'A',
                        'null' => false,
                    ),
                ),
            ),
        ),
        'aggregates' => 
        array (
            'User' => 
            array (
                'class' => 'MODX\\Revolution\\modUser',
                'local' => 'user',
                'foreign' => 'id',
                'cardinality' => 'one',
                'owner' => 'foreign',
            ),
            'Namespace' => 
            array (
                'class' => 'MODX\\Revolution\\modNamespace',
                'local' => 'namespace',
                'foreign' => 'name',
                'cardinality' => 'one',
                'owner' => 'foreign',
            ),
        ),
    );

    public static function listSettings(
        xPDO &$xpdo,
        array $criteria = [],
        array $sort = ['id' => 'ASC'],
        $limit = 0,
        $offset = 0
    ) {
        $c = $xpdo->newQuery(\MODX\Revolution\modUserSetting::class);
        $c->select([
            $xpdo->getSelectColumns(\MODX\Revolution\modUserSetting::class, 'modUserSetting'),
            'Entry.value AS name_trans',
            'Description.value AS description_trans',
        ]);
        $c->leftJoin(\MODX\Revolution\modLexiconEntry::class, 'Entry', "'setting_' + modUserSetting.[key] = Entry.name");
        $c->leftJoin(\MODX\Revolution\modLexiconEntry::class, 'Description', "'setting_' + modUserSetting.[key] + '_desc' = Description.name");
        $c->where($criteria);
        $count = $xpdo->getCount(\MODX\Revolution\modUserSetting::class, $c);
        $c->sortby($xpdo->getSelectColumns(\MODX\Revolution\modUserSetting::class, 'modUserSetting', '', ['area']), 'ASC');
        foreach ($sort as $field => $dir) {
            $c->sortby($xpdo->getSelectColumns(\MODX\Revolution\modUserSetting::class, 'modUserSetting', '', [$field]), $dir);
        }
        if ((int)$limit > 0) {
            $c->limit((int)$limit, (int)$offset);
        }

        return [
            'count' => $count,
            'collection' => $xpdo->getCollection(\MODX\Revolution\modUserSetting::class, $c),
        ];
    }
}
