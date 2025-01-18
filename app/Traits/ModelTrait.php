<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ModelTrait
{
    public function createTranslation($request)
    {
        foreach (config('translatable.locales') as $key) {
            foreach ($this->translatedAttributes as $attribute) {
                if(isset($request[$attribute . '_' . $key]) && $request[$attribute . '_' . $key] !== null){
                    $this->{$attribute . ':' . $key} = $request[$attribute . '_' . $key];
                }
            }
            $this->save();
        }
        return $this;
    }
    
    public function translateOrAny($field) 
    {
        $locale = app()->getLocale();

        if(isset($this->translate($locale)->$field)){
            return $this->$field;
        }
        else{
            return $this->translate('en')->$field ?? $this->translate('ar')->$field ?? '';
        }
    }
    
    public function scopeActive($q) 
    {
        $q->where('status',1);
    }
}
