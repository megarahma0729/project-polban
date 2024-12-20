<?php

namespace App\Models;

use CodeIgniter\Model;

class welcome extends Model
{
    protected $table = 'welcome_message';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'message', 'tentang', 'kontak', 'academic_graduate_year', 'deskripsi', 'desk_surveyor'];

    public function getmessage()
    {
        // Contoh pengambilan pesan terakhir
        $db = \Config\Database::connect();
        $query = $db->query('SELECT id, message, tentang, kontak, academic_graduate_year, deskripsi, desk_surveyor FROM welcome_message');
        return $query->getResultArray();
    }

    public function getJoinedData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        // Join dengan tabel users berdasarkan academic_graduate_year
        $builder->select('welcome_message.*, users.display_name, users.email, users.academic_graduate_year AS user_graduate_year');
        $builder->join('users', 'welcome_message.academic_graduate_year = users.academic_graduate_year');

        return $builder->get()->getResultArray();
    }
}
