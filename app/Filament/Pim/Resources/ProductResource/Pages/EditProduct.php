<?php

namespace App\Filament\Pim\Resources\ProductResource\Pages;

use App\Filament\Pim\Resources\ProductResource;
use App\Helpers\Mapper;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

/**
 * @property Product $record
 */
class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    public function form(Form $form): Form
    {
        $attributes = Mapper::mapProductAttributes($this->record);

        return $form
            ->schema([
                Select::make('family_id')
                    ->label('Family')
                    ->searchable(['name'])
                    ->relationship('family', 'name'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                ...$attributes,
            ] /*+ $attributes*/);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        collect($data)
            ->filter(fn ($value, $key) => str_contains($key, 'attributes-'))
            ->each(function ($value, $key) use (&$data) {
                unset($data[$key]);

                ProductAttributeValue::updateOrInsert([
                    'product_id' => $this->record->id,
                    'attribute_id' => explode('-', $key)[1],
                ], [
                    'attribute_value' => json_encode($value),
                ]);
            });

        return parent::mutateFormDataBeforeSave($data);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $values = $this->record->attributeValues->mapWithKeys(function (ProductAttributeValue $attribute) {
            return [
                'attributes-'.$attribute->attribute_id.'-attribute_value' => $attribute->attribute_value,
            ];
        })->toArray();

        $data += $values;

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
