<?php

namespace App\Filament\User\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\User\Resources\ForumResource\Pages;
use App\Filament\User\Resources\ForumResource\RelationManagers;
use App\Models\Forum;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ForumResource extends Resource
{
    protected static ?string $model = Forum::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function getEmailVerifiedMiddleware(Panel $panel): string
    {
        return parent::getEmailVerifiedMiddleware($panel); // TODO: Change the autogenerated stub
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(191),
                SelectTree::make('category_id')
                    ->label('Select Category')
                    ->enableBranchNode()
                    ->withCount()
                    ->required()
                    ->emptyLabel('Oops! No Category Found')
                    ->relationship('category', 'name', 'parent_id', function ($query){
                        return $query->where('type', 'forum');
                    })->placeholder('Select Category'),
                Textarea::make('summary')
                    ->label('Enter Summary')
                    ->required()
                    ->default('')
                    ->hidden()
                    ->maxLength(191),
                Forms\Components\RichEditor::make('body')
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('forumReplies')
                    ->fileAttachmentsVisibility('public')
                    ->required(),
                Forms\Components\Hidden::make('user_id')
                    ->default(fn() => auth()->user()->id)
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('body')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('Reply')
                        ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ])
            ])->actionsColumnLabel('Actions')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc');
            });
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ForumReplyRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForums::route('/'),
            'create' => Pages\CreateForum::route('/create'),
            'edit' => Pages\EditForum::route('/{record}/edit'),
        ];
    }
}
