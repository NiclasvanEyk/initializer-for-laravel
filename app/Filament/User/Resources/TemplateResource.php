<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\TemplateResource\Pages;
use App\Models\Template;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TemplateResource extends Resource
{
    protected static ?string $model = Template::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';

    public static function form(Form $form): Form
    {
        $names = collect([
            'Pesty Breeze',
            'Breezy Vue with Postgres',
            'Api Preset',
            'Redis all the way!',
            'Barebones',
            'TALL Stack',
            'MyAgency Defaults',
            'Taylor\'s Version',
        ]);

        return $form
            ->schema([
                Section::make('Metadata')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->placeholder($names->random())
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\Radio::make('visibility')
                            ->options(['public' => 'Public', 'private' => 'Private'])
                            ->default('private')
                            ->columnSpanFull()
                            ->descriptions([
                                'public'  => 'Public templates can be shared, but files are accessible to everyone',
                                'private' => 'Only you can use this template, it cannot be shared',
                            ])
                            ->required(),
                        Forms\Components\MarkdownEditor::make('description')
                            ->hint('Markdown supported')
                            ->disableAllToolbarButtons()
                            ->columnSpanFull(),
                    ]),
                Section::make('Customization')
                    ->description(str(<<<'MARKDOWN'
                    The way templates work for now is simple: you upload a ZIP-archive containing files.
                    These files are then copied into the default Laravel template.
                    This is done after the starter kit is applied, but before all other components are installed into the application.

                    Test another paragraph with some _emphasized_ text.
                    MARKDOWN)->inlineMarkdown()->toHtmlString())
                    ->schema([
                        Forms\Components\FileUpload::make('path')
                            ->label('Template')
                            ->hint('*.zip only, max. 10MB')
                            ->acceptedFileTypes(['application/zip'])
                            ->maxSize(10_000) // 10MB
                            ->disk('templates')
                            ->directory(fn () => Filament::getTenant()->getKey())
                            ->required()
                            ->downloadable()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('query-string')
                            ->prefix(url('?preset&'))
                            ->placeholder('database=postgres&cache=redis&...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTemplates::route('/'),
            'create' => Pages\CreateTemplate::route('/create'),
            'edit'   => Pages\EditTemplate::route('/{record}/edit'),
        ];
    }
}
