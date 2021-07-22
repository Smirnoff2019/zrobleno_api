<?php
namespace App\Notifications\NotificationHelper;

class TemplateParser

{

    private $content = "", $data = [];
    public function __construct(string $content, array $data = [])
    {
        $this->content = $content;
        $this->data = $data;
        $this->parse();
    }

    public function parse (){
        foreach ($this->data as $key => $value) {
            $this->content = str_replace("{{".$key."}}", $value, $this->content);
        }
    }

    public function getContent () {
        return $this->content;
    }
}
