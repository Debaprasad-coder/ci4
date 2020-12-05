<?php 
namespace App\Models;
//use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class User extends Model
{
    
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'email', 'password'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     *------------------
     * Validation
     *------------------
     protected $validationRules    = [
        'username'     => 'required|alpha_numeric_space|min_length[3]',
        'email'        => 'required|valid_email|is_unique[users.email]',
        'password'     => 'required|min_length[8]',
        'pass_confirm' => 'required_with[password]|matches[password]'
    ];

    protected $validationMessages = [
        'email'        => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.'
        ]
    ];
     */
    /**
        protected function hashPassword(array $data)
        {
            if (! isset($data['data']['password']) return $data;

            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            unset($data['data']['password'];

            return $data;
        }
    */
    public function hashPassword(array $data)
    {
        //echo "<pre>";print_r($data);exit;
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }   

}