<?php
interface DataAccess {
    public function getById(int $id);
    public function getAll();
}