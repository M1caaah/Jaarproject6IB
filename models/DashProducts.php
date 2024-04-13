<?php

namespace app\models;

use app\core\DbModel;

class DashProducts extends DbModel
{
    public int $product_id = 0;
    public string $productName = '';
    public string $description = '';
    public string $imagePath = '';
    public string $price = '';

    public static function tableName(): string
    {
        return 'tblproducts';
    }

    public static function primaryKey(): string
    {
        return 'product_id';
    }

    public function attributes(): array
    {
        return ['productName', 'description', 'imagePath', 'price'];
    }

    public function datatypes(): string
    {
        return 'ssss';
    }

    public function labels(): array
    {
        return [
            'productName' => 'Product Name',
            'description' => 'Description',
            'price' => 'Price'
        ];
    }

    public function rules(): array
    {
        return [
            'productName' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
            'imagePath' => [self::RULE_FILE_REQUIRED, [self::RULE_FILE_SIZE, 'size' => 1024 * 1024 * 3]]
        ];
    }

    public function save()
    {
        $file = $_FILES['imagePath'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];

        $imageDir = '/productImages/';
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . $imageDir;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($fileTmp, $uploadDir . $fileName)) {
            $this->imagePath = $imageDir. $fileName;
        }
        $this->insert();
        return true;
    }
}