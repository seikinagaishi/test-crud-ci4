<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model {
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario', 'senha'];
    protected $returnType = 'object';
}