<?php

namespace Jangvel\NovaGutenberg;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\Field;
use VanOns\Laraberg\Blocks\ContentRenderer;

class NovaGutenberg extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-gutenberg';

    public $showOnIndex = false;

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->loadDefaults();

        $this->displayCallback = function ($value, $model) use ($attribute) {
            if (method_exists($model, 'render')) {
                return $model->render($attribute);
            }

            return $value;
        };
    }

    protected function loadDefaults() {
        $this->settings(
            $this->keysToCamelRecursive(
                config('laraberg-nova.defaults', [])
            )
        );
    }

    protected function keysToCamelRecursive(array $arr) {
        $result = [];
        foreach ($arr as $key => $value) {
            $camel = str_starts_with($key, '__')
                ? '__' . Str::camel($key)
                : Str::camel($key);

            $result[$camel] = is_array($value)
                ? $this->keysToCamelRecursive($value)
                : $value;
        }

        return $result;
    }

    public function height(int $height): self
    {
        return $this->withSettings(['height' => $height]);
    }

    public function disabledCoreBlocks(array $disabledCoreBlocks): self
    {
        return $this->withSettings(compact('disabledCoreBlocks'));
    }

    public function alignWide(bool $alignWide): self
    {
        return $this->withSettings(compact('alignWide'));
    }

    public function supportsLayout(bool $supportsLayout): self
    {
        return $this->withSettings(compact('supportsLayout'));
    }

    public function maxWidth(int $maxWidth): self
    {
        return $this->withSettings(compact('maxWidth'));
    }

    public function imageEditing(bool $imageEditing): self
    {
        return $this->withSettings(compact('imageEditing'));
    }

    public function colors(array $colors): self
    {
        return $this->withSettings(compact('colors'));
    }

    public function gradients(array $gradients): self
    {
        return $this->withSettings(compact('gradients'));
    }

    public function fontSizes(array $fontSizes): self
    {
        return $this->withSettings(compact('fontSizes'));
    }

    public function withSettings(array $settings): self
    {
        $settings = array_merge(
            $this->meta['settings'] ?? [],
            $settings
        );

        return $this->withMeta(compact('settings'));
    }

    public function settings(array $settings): self
    {
        return $this->withSettings($settings);
    }

    /**
     * Resolve the field's value for display.
     *
     * @param  mixed  $resource
     * @param  string|null  $attribute
     * @return void
     */
    public function resolveForDisplay($resource, $attribute = null)
    {
        parent::resolveForDisplay($resource, $attribute);
        $renderer = app(ContentRenderer::class);

        $this->value = $renderer->render(is_string($this->value) ? $this->value : '');
    }
}
