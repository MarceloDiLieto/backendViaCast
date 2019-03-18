<?php

namespace App\Data;

interface IRepository
{
    public function createUser($user);
    public function readAllUsers();
    public function readUserById($id);
    public function updateUser($user);
    public function deleteUser($id);
}