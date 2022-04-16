<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class AuthModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'UserID';
    protected $useTimestamps = false;
    protected $createdField  = 'CreatedAt';
    protected $updatedField  = 'UpdatedAt';
    protected $allowedFields = ['Email', 'Username', 'Password'];

    public function RegisterNewUser($data)
    {
        $now = date_create()->format('Y-m-d H:i:s');
        $uuid = Uuid::uuid4()->getBytes();
        $username = $data['username'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = $this->db->query("INSERT INTO `users`(`UserID`,`Email`,`Username`,`Password`,`CreatedAt`,`UpdatedAt`) VALUES ('$uuid','$email','$username','$password','$now','$now');");
        return $query;
    }
}
