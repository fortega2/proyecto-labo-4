<?php
interface CRUD {
    public function insert(object $object);
    public function update(object $object);
    public function delete(int $id);
}
?>