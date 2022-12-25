<?php


namespace App\Repository;


class SubscriptionRepository
{

    public function getMailReceiver($countryDialCode) {
        return (object) $this->mailsInfo()[$countryDialCode];
    }

    public function mailsInfo() {
        return [
            221 => [
                'mail' => 'reception.senegal.omoide.sn@gmail.com',
                'smtp' => 'senegal'
            ],
            229 => [
                'mail' => 'reception.benin.omoide.sn@gmail.com',
                'smtp' => 'benin'
            ],
            241 => [
                'mail' => 'reception.gabon.omoide.sn@gmail.com',
                'smtp' => 'gabon'
            ],
            225 => [
                'mail' => 'reception.cotedivoire.omoide.sn@gmail.com',
                'smtp' => 'ivory'
            ]
        ];
    }
}
