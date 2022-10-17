<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\Brand;

class BrandTranslation extends Model
{
    protected $baseModuleModel = Brand::class;
}
