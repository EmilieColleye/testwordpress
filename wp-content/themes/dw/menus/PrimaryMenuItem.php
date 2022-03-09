<?php
class PrimaryMenuItem{

    protected $post;

    public $url;
    public $label;
    public $title;
    public $subitems = [];

    public function __construct(){
        $this->post = $post;
        $this->url = $post->url;
        $this->label = $post->title;
        $this->title = $post->attr_title;

    }

    public function hasSubItems(){
        return !empty($this->subitems);
    }

    public function isSubItems(){
        return !empty($this->subitems);
    }
}