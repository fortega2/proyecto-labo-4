<?php
interface CRUD {
    public function getById(int $id);
    public function getAll();
    public function insert(object $object);
    public function update(object $object);
    public function delete(int $id);
}
?>