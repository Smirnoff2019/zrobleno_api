<?php

namespace App\Traits\Notification;

use App\Channels\TelegramChannel;

/**
 * Trait        NotificationSortTrait
 * @package     App\Traits\Notification
 */
trait NotificationBindingTrait
{
    private $binding = [
        'telegram' => TelegramChannel::class
    ];

    public function checkBinding (array $types) {
        if(is_array($types)) {
            foreach ($types as $key => $type) {
                if(isset($this->binding[$type])){
                    $types[$key] = $this->binding[$type];
                }
            }
        }else {
            $types = [];
        }
        return $types;
    }
}
