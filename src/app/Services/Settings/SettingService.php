<?php

namespace App\Services\Settings;

use App\Services\Core\BaseService;
use App\Services\Core\Setting\DeliverySettingService;

class SettingService extends BaseService
{
    public function getMailSettings()
    {
        $service = resolve(DeliverySettingService::class);

        $default = $service
            ->getDefaultSettings();

        return $service
            ->getFormattedDeliverySettings([
                optional($default)->value,
                'default_mail_email_name'
            ]);
    }

    public function getCachedMailSettings()
    {
        return cache()->remember('app-delivery-settings', 86400, function () {
            return $this->getMailSettings();
        });
    }

   /* public function getTenantFormattedSettings()
    {
        return cache()->remember('app-current-tenant-setting-'.optional(tenant())->id, 84000, function () {
            return resolve(TenantSettingService::class)
                ->getFormattedTenantSettings();
        });
    }*/

}
