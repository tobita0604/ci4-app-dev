<?php

namespace App\Models\Template;

use CodeIgniter\Model;

/**
 * テンプレートモデル
 * 
 * テンプレートデータのCRUD操作を提供
 */
class TemplateModel extends Model
{
    protected $table            = 'templates';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category_id',
        'name',
        'slug',
        'type',
        'description',
        'content',
        'variables',
        'is_active',
        'version',
        'created_by',
        'updated_by',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name'        => 'required|min_length[3]|max_length[255]',
        'slug'        => 'required|is_unique[templates.slug,id,{id}]|alpha_dash',
        'type'        => 'required|in_list[html,email,notification,other]',
        'content'     => 'permit_empty|string',
        'category_id' => 'permit_empty|integer',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'テンプレート名は必須です',
            'min_length' => 'テンプレート名は3文字以上で入力してください',
        ],
        'slug' => [
            'required'  => 'スラッグは必須です',
            'is_unique' => 'このスラッグは既に使用されています',
        ],
        'type' => [
            'required' => 'テンプレートタイプは必須です',
            'in_list'  => '有効なテンプレートタイプを選択してください',
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
     * カテゴリ情報を含むテンプレート一覧取得
     * 
     * @param array $filters フィルター条件
     * @return array
     */
    public function getTemplatesWithCategory(array $filters = []): array
    {
        $builder = $this->builder();
        
        $builder->select('templates.*, categories.name as category_name')
                ->join('categories', 'categories.id = templates.category_id', 'left');

        if (!empty($filters['type'])) {
            $builder->where('templates.type', $filters['type']);
        }

        if (!empty($filters['category_id'])) {
            $builder->where('templates.category_id', $filters['category_id']);
        }

        if (isset($filters['is_active'])) {
            $builder->where('templates.is_active', $filters['is_active']);
        }

        return $builder->orderBy('templates.created_at', 'DESC')->get()->getResultArray();
    }

    /**
     * スラッグからテンプレート取得
     * 
     * @param string $slug スラッグ
     * @return array|null
     */
    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * テンプレート変数のJSON文字列をデコード
     * 
     * @param array $template テンプレートデータ
     * @return array
     */
    public function decodeVariables(array $template): array
    {
        if (!empty($template['variables']) && is_string($template['variables'])) {
            $template['variables'] = json_decode($template['variables'], true);
        }

        return $template;
    }
}
