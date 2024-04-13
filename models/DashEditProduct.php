<?php

namespace app\models;

use app\models\DashProducts;

class DashEditProduct extends DashProducts
{
    public function rules(): array
    {
        return [
            'productName' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
            'imagePath' => [[self::RULE_FILE_SIZE, 'size' => 1024 * 1024 * 3]]
        ];
    }

    public function save()
    {
        if ($_FILES['imagePath']['error'] === 4) {
            $this->imagePath = $this->select(['imagePath'], 'product_id = '.$this->product_id)[0]['imagePath'];
            return $this->update($this->product_id);
        }
        $file = $_FILES['imagePath'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];

        $imageDir = '/productImages/';

        $this->imagePath = $imageDir . $fileName;

        move_uploaded_file($fileTmp, dirname(__DIR__) . '/public' . $this->imagePath);
        return $this->update($this->product_id);
    }
}