<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

trait Localizable
{
    /**
     * @return HasMany
     */
    public function locales(): HasMany
    {
        return $this->hasMany($this->localeModel, $this->getForeignKey(), 'id');
    }

    /**
     * @return HasOne
     */
    public function locale(): HasOne
    {
        return $this->hasOne($this->localeModel, $this->getForeignKey(), 'id')
            ->where('local', app()->getLocale());
    }

    /**
     * Set model locales
     * @param array $locales
     */
    public function setLocales(array $locales): void
    {
        $insertData = [];
        foreach ($locales as $locale) {
            $localeRecord = [
                "id" => Str::uuid(),
                $this->getForeignKey() => $this->getKey(),
                'local' => $locale['local'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            foreach ($this->localableFields as $field) {
                $localeRecord[$field] = $locale[$field] ?? null;
            }

            $insertData[] = $localeRecord;
        }
        (new $this->localeModel)::where($this->getForeignKey(), $this->getKey())->delete();
        ((new $this->localeModel))::insert($insertData);
    }
}