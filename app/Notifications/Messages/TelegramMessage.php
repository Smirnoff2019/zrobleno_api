<?php

namespace App\Notifications\Messages;
use App\Models\User\User;
class TelegramMessage {

    private $user, $_content = "", $methodType = [], $action = "";

    public function setUser (User $user) : TelegramMessage {
        $this->user = $user;
        return  $this;
    }

    public function setContent (string $content) : TelegramMessage {
        $this->_content = $content;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getContent () : string
    {
        return  $this->_content;
    }

    public function setAction (string $url) : TelegramMessage {
        $this->action = $url;
        return $this;
    }

    public function getAction () : string  {
        return  $this->action;
    }


    public function getMethodType () : array  {
        return  $this->methodType;
    }
}
