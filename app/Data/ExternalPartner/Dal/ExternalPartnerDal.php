<?php
namespace App\Data\ExternalPartner\Dal;

use \App\Data\ExternalPartner\Model\ExternalPartner;
use \App\Data\Translation\Dal\TranslationDal;

class ExternalPartnerDal
{
    public function getList(bool $translateData = false)
    {
        $entityName = 'external_partner';
        $baseFields = [
            'external_partner.id',
            'external_partner.external_partner_category_id',
            'external_partner.name',
            'external_partner.short_info',
            'external_partner.site_url',
            'external_partner.logo_path'
        ];
        $entity = ExternalPartner::with(['category']);
        TranslationDal::generateQuery($entityName, $entity, $baseFields, $translateData);

        return $entity->get();
    }

    public function get($id, bool $translateData = false)
    {
        $entityName = 'external_partner';
        $baseFields = [
            'external_partner.id',
            'external_partner.info',
        ];
        $entity = ExternalPartner::where('id', $id);
        TranslationDal::generateQuery($entityName, $entity, $baseFields, $translateData);

        return $entity->first();
    }
}