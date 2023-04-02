<?php


namespace Tests\Services;


use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SearchColorService
{

    private Collection $colors;

    public function __construct()
    {
        $colors = config('cars_colors', []);

        $this->colors = new Collection($colors);
    }

    public static function init(): SearchColorService
    {
        return new self();
    }

    /**
     * @param string $title
     * @param string $default
     *
     * @return string
     */
    public function hex(string $title, string $default = '#000000'): string
    {
        return $this->get('hex', $title, $default);
    }

    /**
     * @param string $title
     * @param string $default
     *
     * @return string
     */
    public function basename(string $title, string $default = ''): string
    {
        return $this->get('name', $title, $default);
    }

    /**
     * @param string $key
     * @param string $haystack
     * @param string $default
     *
     * @return array|\ArrayAccess|mixed|string
     */
    private function get(string $key, string $haystack, string $default)
    {
        $haystack = Str::lower($haystack);

        foreach ($this->colors as $item) {
            if (Str::contains($haystack, Arr::get($item, 'pattern'))) {
                return Arr::get($item, $key);
            }
        }

        return $default;
    }
}
