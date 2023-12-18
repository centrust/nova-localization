<?php

namespace Centrust\NovaLocalization\Nova;

use App\Nova\Resource;
use Centrust\NovaLocalization\Models\Localization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Outl1ne\NovaInlineTextField\InlineText;


class NovaLocalizationResource extends Resource
{

    public static $clickAction = 'ignore';
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\Centrust\NovaLocalization\Models\Localization>
     */
    public static $model = Localization::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static function label()
    {
        return _tran('Localizations');
    }

    public static function singularLabel()
    {
        return _tran('Localization');
    }


    public static function afterUpdate(NovaRequest $request, Model $model)
    {
        $group = $model->group == 'default'?'': $model->group;
        $term = $group.'.'.$model->term;
        Cache::forget('Translation.'.$term);

    }
    public static $perPageOptions = [10, 20, 50, 100];
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'term';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','term','group','ar','en'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Term')->sortable()->showOnPreview()->hideFromIndex()->readonly(),
            Text::make('Term', 'term')->displayUsing(function($title)  {
                return   Str::length($title) < 30 ? Str::title($title) : Str::substr(Str::title($title), 0, 30) .  '....';
            })->onlyOnIndex(),
            Text::make('Group')->sortable()->readonly(),

         new Panel(_tran('Localizations'), $this->LocalizationFileds()),

        ];
    }

    protected function LocalizationFileds(){
        return [
            Text::make('Ar')->sortable()->showOnPreview()->hideFromIndex(),
            InlineText::make('Ar','ar'),

            Text::make('En')->sortable()->showOnPreview()->hideFromIndex(),
            InlineText::make('En', 'en'),
        ];
    }


    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
