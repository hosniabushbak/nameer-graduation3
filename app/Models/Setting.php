<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['key', 'value'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('company_logo')
            ->singleFile()
            ->useDisk('public');
    }

    public static function setSetting($data)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        foreach ($data as $key => $value) {
            if (!is_null($value)) {
                if ($key === 'company_logo' && request()->hasFile('company_logo')) {
                    $setting = self::where('key', $key)->first() ?? new self(['key' => $key]);
                    $setting->save();
                    $setting->addMediaFromRequest('company_logo')
                        ->toMediaCollection('company_logo');
                } else {
                    self::updateOrCreate(['key' => $key], ['value' => $value]);
                }
            }
        }
        return true;
    }

    public function key($key)
    {
        return $this->where(['key' => $key])->first();
    }

    public function valueOf($type, $default = null)
    {
        if($this->first()) {
            return $this->key($type) ? $this->key($type)->value : $default;
        }
        return '';
    }

    public function getLogoUrlAttribute()
    {
        try {
            $setting = self::where('key', 'company_logo')->first();
            if ($setting && $media = $setting->getFirstMedia('company_logo')) {
                // طباعة المسار للتأكد
                \Log::info('Media URL:', [
                    'url' => $media->getUrl(),
                    'original_url' => $media->original_url,
                    'path' => $media->getPath(),
                    'full_url' => asset('storage/' . $media->id . '/' . $media->file_name)
                ]);

                return asset('storage/' . $media->id . '/' . $media->file_name);
            }
        } catch (\Exception $e) {
            \Log::error('Error getting logo URL: ' . $e->getMessage());
        }
        return null;
    }
}