<?php

namespace App\Models\Template;

use CodeIgniter\Model;

/**
 * テンプレートバージョンモデル
 * 
 * テンプレートバージョン履歴のCRUD操作を提供
 */
class VersionModel extends Model
{
    protected $table            = 'template_versions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'template_id',
        'version_number',
        'content',
        'variables',
        'change_description',
        'created_by',
    ];

    // Dates
    protected $useTimestamps = false; // created_atのみ使用
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    // Validation
    protected $validationRules = [
        'template_id'    => 'required|integer',
        'version_number' => 'required|integer',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;

    /**
     * テンプレートの全バージョン取得
     * 
     * @param int $templateId テンプレートID
     * @return array
     */
    public function getVersionsByTemplateId(int $templateId): array
    {
        return $this->where('template_id', $templateId)
                    ->orderBy('version_number', 'DESC')
                    ->findAll();
    }

    /**
     * 特定バージョンの取得
     * 
     * @param int $templateId テンプレートID
     * @param int $versionNumber バージョン番号
     * @return array|null
     */
    public function getVersion(int $templateId, int $versionNumber): ?array
    {
        return $this->where('template_id', $templateId)
                    ->where('version_number', $versionNumber)
                    ->first();
    }
}
