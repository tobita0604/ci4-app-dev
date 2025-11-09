<?php

namespace App\Models\Template;

use CodeIgniter\Model;

/**
 * カテゴリモデル
 * 
 * カテゴリデータのCRUD操作を提供
 */
class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'slug',
        'description',
        'parent_id',
        'display_order',
        'is_active',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name'          => 'required|min_length[2]|max_length[100]',
        'slug'          => 'required|is_unique[categories.slug,id,{id}]|alpha_dash',
        'parent_id'     => 'permit_empty|integer',
        'display_order' => 'permit_empty|integer',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'カテゴリ名は必須です',
            'min_length' => 'カテゴリ名は2文字以上で入力してください',
        ],
        'slug' => [
            'required'  => 'スラッグは必須です',
            'is_unique' => 'このスラッグは既に使用されています',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * 階層構造を持つカテゴリ一覧取得
     * 
     * @param bool $activeOnly 有効なカテゴリのみ取得するか
     * @return array
     */
    public function getHierarchicalCategories(bool $activeOnly = true): array
    {
        $builder = $this->builder();
        
        $builder->select('c1.*, c2.name as parent_name')
                ->from('categories c1')
                ->join('categories c2', 'c1.parent_id = c2.id', 'left');

        if ($activeOnly) {
            $builder->where('c1.is_active', 1);
        }

        $builder->orderBy('c1.display_order', 'ASC');

        return $builder->get()->getResultArray();
    }

    /**
     * 親カテゴリのみ取得
     * 
     * @return array
     */
    public function getParentCategories(): array
    {
        return $this->where('parent_id', null)
                    ->where('is_active', 1)
                    ->orderBy('display_order', 'ASC')
                    ->findAll();
    }

    /**
     * 子カテゴリ取得
     * 
     * @param int $parentId 親カテゴリID
     * @return array
     */
    public function getChildCategories(int $parentId): array
    {
        return $this->where('parent_id', $parentId)
                    ->where('is_active', 1)
                    ->orderBy('display_order', 'ASC')
                    ->findAll();
    }

    /**
     * スラッグからカテゴリ取得
     * 
     * @param string $slug スラッグ
     * @return array|null
     */
    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->first();
    }
}
