<?php

class Comment {
    private int $id;
    private string $info;
    private int $parentId;

    public function __construct(int $id, string $info, int $parentId) {
        $this->id = $id;
        $this->info = $info;
        $this->parentId = $parentId;
    }
}