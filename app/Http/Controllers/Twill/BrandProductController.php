<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use App\Repositories\BrandRepository;

class BrandProductController extends BaseModuleController
{
    protected $modelName = 'BrandProduct';

    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->setModuleName('brands.products');
    }

    protected function getParentModuleForeignKey()
    {
        return 'brand_id';
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Input::make()->name('description')->label('Description')->translatable()
        );

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('description')->title('Description')
        );

        return $table;
    }

    protected function indexData($request): array
    {
        $brand = app(BrandRepository::class)->getById(request('brand'));

        return [
            'breadcrumb' => [
                [
                    'label' => 'Brands',
                    'url' => moduleRoute('brands', '', 'index'),
                ],
                [
                    'label' => $brand->title,
                    'url' => moduleRoute('brands', '', 'edit', $brand->id),
                ],
                [
                    'label' => 'Products',
                ],
            ],
        ];
    }

    protected function formData($request): array
    {
        $brand = app(BrandRepository::class)->getById(request('brand'));

        return [
            'breadcrumb' => [
                [
                    'label' => 'Brands',
                    'url' => moduleRoute('brands', '', 'index'),
                ],
                [
                    'label' => $brand->title,
                    'url' => moduleRoute('brands', '', 'edit', $brand->id),
                ],
                [
                    'label' => 'Products',
                    'url' => moduleRoute('brands.products', '', 'index'),
                ],
                [
                    'label' => 'Edit',
                ],
            ],
        ];
    }
}
