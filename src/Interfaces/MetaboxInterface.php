<?php

namespace Estatik\Interfaces;

interface MetaboxInterface
{
    public function add_metabox();
    public function metabox_callback($post);
    public function save_metabox($post_id);
}