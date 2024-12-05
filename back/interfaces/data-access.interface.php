<?php
interface DataAccess {
    public function getById(int $id);
    public function getAll();
}

interface DataAccessCode extends DataAccess {
    public function getByCode(string $codigo);
}
