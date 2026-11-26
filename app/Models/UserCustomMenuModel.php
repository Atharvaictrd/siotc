<?php

namespace App\Models;

use CodeIgniter\Model;

class UserCustomMenuModel extends Model
{
    protected $table            = 'user_custom_menus';
    protected $primaryKey       = 'menu_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'user_id',
        'parent_id',
        'menu_name',
        'route',
        'icon',
        'sort_order',
        'is_menu',
        'status',
        'updated_at'
    ];

    protected $useTimestamps = false;

    // Get all custom menus of a particular user
    public function getUserMenus($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }

    // Get only parent menus
    public function getParentMenus($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('parent_id', null)
                    ->where('status', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }

    // Get submenu items
    public function getSubMenus($parentId, $userId)
    {
        return $this->where('parent_id', $parentId)
                    ->where('user_id', $userId)
                    ->where('status', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}
