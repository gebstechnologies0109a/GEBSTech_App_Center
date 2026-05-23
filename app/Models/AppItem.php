<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AppItem extends Model
{
    public const CATEGORY_FUTURE = 'Future';

    public const STATUS_ACTIVE = 'active';

    public const STATUS_INACTIVE = 'inactive';

    protected $table = 'apps';

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'logo_path',
        'download_link',
        'status',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function logoUrl(): ?string
    {
        if (! $this->logo_path) {
            return null;
        }

        if (Str::startsWith($this->logo_path, ['http://', 'https://'])) {
            return $this->logo_path;
        }

        return asset(ltrim($this->logo_path, '/'));
    }

    public function downloadUrl(): string
    {
        return $this->download_link ?: '#';
    }

    public function isExternalDownloadLink(): bool
    {
        $url = $this->download_link;

        return is_string($url)
            && $url !== ''
            && $url !== '#'
            && ! str_starts_with($url, '#');
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isFuture(): bool
    {
        return $this->category === self::CATEGORY_FUTURE;
    }

    /**
     * Summary text before feature bullet lines in description.
     */
    public function descriptionSummary(): string
    {
        $lines = $this->descriptionLines();
        $summary = [];

        foreach ($lines as $line) {
            if ($this->isFeatureLine($line)) {
                break;
            }

            $summary[] = $line;
        }

        return trim(implode("\n", $summary));
    }

    /**
     * @return list<string>
     */
    public function featureList(): array
    {
        $features = [];

        foreach ($this->descriptionLines() as $line) {
            if ($this->isFeatureLine($line)) {
                $features[] = $this->normalizeFeatureLine($line);
            }
        }

        return $features;
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeListed(Builder $query): Builder
    {
        return $query
            ->where('status', self::STATUS_ACTIVE)
            ->where('category', '!=', self::CATEGORY_FUTURE)
            ->orderBy('category')
            ->orderBy('name');
    }

    /**
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeFuture(Builder $query): Builder
    {
        return $query
            ->where('category', self::CATEGORY_FUTURE)
            ->orderBy('name');
    }

    /**
     * @return list<string>
     */
    private function descriptionLines(): array
    {
        return preg_split("/\r\n|\n|\r/", (string) $this->description) ?: [];
    }

    private function isFeatureLine(string $line): bool
    {
        $trimmed = ltrim($line);

        return str_starts_with($trimmed, '- ')
            || str_starts_with($trimmed, '• ')
            || str_starts_with($trimmed, '* ');
    }

    private function normalizeFeatureLine(string $line): string
    {
        return preg_replace('/^[\-\•\*]\s+/', '', ltrim($line)) ?? ltrim($line);
    }
}
