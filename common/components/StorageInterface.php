<?php

namespace common\components;

use yii\web\UploadedFile;

/**
 * Description of StorageInterface
 *
 * @author hodym
 */
interface StorageInterface 
{
    public function saveUploadedFile(UploadedFile $file);
    
    public function getFile(string $filename);
}
