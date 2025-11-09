<?php

namespace App\Services\Template;

use App\Models\Template\TemplateModel;
use App\Models\Template\TemplateVersionModel;

/**
 * テンプレートサービス
 * 
 * テンプレートに関するビジネスロジックを管理
 */
class TemplateService
{
    protected TemplateModel $templateModel;
    protected TemplateVersionModel $versionModel;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->templateModel = new TemplateModel();
        $this->versionModel = new TemplateVersionModel();
    }

    /**
     * テンプレート一覧取得
     * 
     * @param array $filters フィルター条件
     * @param int $perPage ページあたりの件数
     * @return array
     */
    public function getTemplates(array $filters = [], int $perPage = 20): array
    {
        return $this->templateModel->getTemplatesWithCategory($filters);
    }

    /**
     * テンプレート詳細取得
     * 
     * @param int $id テンプレートID
     * @return array|null
     */
    public function getTemplate(int $id): ?array
    {
        $template = $this->templateModel->find($id);
        
        if ($template) {
            $template = $this->templateModel->decodeVariables($template);
        }

        return $template;
    }

    /**
     * テンプレート作成
     * 
     * @param array $data テンプレートデータ
     * @param int $userId 作成者ID
     * @return int|false 作成されたテンプレートIDまたはfalse
     */
    public function createTemplate(array $data, int $userId)
    {
        // 変数をJSON文字列に変換
        if (!empty($data['variables']) && is_array($data['variables'])) {
            $data['variables'] = json_encode($data['variables']);
        }

        $data['created_by'] = $userId;
        $data['version'] = 1;

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // テンプレートを作成
            $templateId = $this->templateModel->insert($data);

            if ($templateId) {
                // 初版バージョンを作成
                $versionData = [
                    'template_id'        => $templateId,
                    'version_number'     => 1,
                    'content'            => $data['content'] ?? '',
                    'variables'          => $data['variables'] ?? null,
                    'change_description' => '初版作成',
                    'created_by'         => $userId,
                ];

                $this->versionModel->insert($versionData);
            }

            $db->transComplete();

            return $db->transStatus() === false ? false : $templateId;
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Template creation failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * テンプレート更新
     * 
     * @param int $id テンプレートID
     * @param array $data 更新データ
     * @param int $userId 更新者ID
     * @param string $changeDescription 変更内容の説明
     * @return bool
     */
    public function updateTemplate(int $id, array $data, int $userId, string $changeDescription = ''): bool
    {
        $template = $this->templateModel->find($id);
        
        if (!$template) {
            return false;
        }

        // 変数をJSON文字列に変換
        if (!empty($data['variables']) && is_array($data['variables'])) {
            $data['variables'] = json_encode($data['variables']);
        }

        $data['updated_by'] = $userId;
        $newVersion = (int)$template['version'] + 1;
        $data['version'] = $newVersion;

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // テンプレートを更新
            $this->templateModel->update($id, $data);

            // 新バージョンを作成
            $versionData = [
                'template_id'        => $id,
                'version_number'     => $newVersion,
                'content'            => $data['content'] ?? $template['content'],
                'variables'          => $data['variables'] ?? $template['variables'],
                'change_description' => $changeDescription,
                'created_by'         => $userId,
            ];

            $this->versionModel->insert($versionData);

            $db->transComplete();

            return $db->transStatus() !== false;
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Template update failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * テンプレート削除
     * 
     * @param int $id テンプレートID
     * @return bool
     */
    public function deleteTemplate(int $id): bool
    {
        try {
            return $this->templateModel->delete($id);
        } catch (\Exception $e) {
            log_message('error', 'Template deletion failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * テンプレート複製
     * 
     * @param int $id 複製元テンプレートID
     * @param int $userId 作成者ID
     * @return int|false 複製されたテンプレートIDまたはfalse
     */
    public function duplicateTemplate(int $id, int $userId)
    {
        $original = $this->templateModel->find($id);
        
        if (!$original) {
            return false;
        }

        // 複製用データを準備
        $duplicateData = $original;
        unset($duplicateData['id']);
        unset($duplicateData['created_at']);
        unset($duplicateData['updated_at']);
        
        $duplicateData['name'] = $original['name'] . ' (コピー)';
        $duplicateData['slug'] = $original['slug'] . '-copy-' . time();
        $duplicateData['version'] = 1;
        $duplicateData['created_by'] = $userId;

        return $this->createTemplate($duplicateData, $userId);
    }

    /**
     * テンプレート変数の置換
     * 
     * @param string $content テンプレート本文
     * @param array $variables 置換する変数（キー: 変数名、値: 置換値）
     * @return string 置換後の本文
     */
    public function replaceVariables(string $content, array $variables): string
    {
        foreach ($variables as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
        }

        return $content;
    }
}
