<?php
/**
 * IDPay payment gateway
 *
 * @developer JMDMahdi
 * @publisher IDPay
 * @copyright (C) 2018 IDPay
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 or later
 *
 * http://idpay.ir
 */
namespace IDPay\IDPay;

use XF\AddOn\AbstractSetup;

class Setup extends AbstractSetup
{
    public function upgrade(array $stepParams = [])
    {
        $this->uninstall();
        $this->install();
    }

    public function install(array $stepParams = [])
    {
        $entity = \XF::em()->create('XF:PaymentProvider');
        $entity->bulkSet(
            [
                'provider_id' => "IDPay",
                'provider_class' => "IDPay\\IDPay\\IDPay",
                'addon_id' => "IDPay/IDPay"
            ]
        );
        $entity->save();
    }

    public function uninstall(array $stepParams = [])
    {
        $entity = \XF::em()->find('XF:PaymentProvider', 'IDPay');
        if (!empty($entity)) {
            $entity->delete();
        }
    }
}