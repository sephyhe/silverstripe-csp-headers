<?php


namespace Firesphere\CSPHeaders\Extensions;

use Firesphere\CSPHeaders\Models\CSPDomain;
use Page;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\Tab;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\ManyManyList;

/**
 * Class \Firesphere\CSPHeaders\Extensions\SiteTreeExtension
 *
 * @property Page|PageExtension $owner
 * @method ManyManyList|CSPDomain[] CSPDomains()
 */
class PageExtension extends DataExtension
{
    private static $many_many = [
        'CSPDomains' => CSPDomain::class
    ];

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root', Tab::create(
            'CSP',
            _t(SiteTree::class . '.CSP', 'Content Security Policies')
        ));

        $config = GridFieldConfig_RelationEditor::create();
        $gridfield = GridField::create(
            'CSPDomains',
            _t(SiteTree::class . '.CSP', 'Content Security Policy Domains'),
            $this->owner->CSPDomains(),
            $config
        );
        $fields->addFieldToTab('Root.CSP', $gridfield);
    }
}
