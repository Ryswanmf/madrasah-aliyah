<?php

if (! function_exists('webp_asset')) {
    /**
     * Return WebP version of an asset if it exists, otherwise return original asset.
     */
    function webp_asset(?string $path): string
    {
        if (empty($path)) {
            return asset('assets/images/gedung-1.webp');
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $cleanPath = ltrim($path, '/');
        $webpPath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $cleanPath);

        if (file_exists(public_path($webpPath))) {
            return asset($webpPath);
        }

        return asset($cleanPath);
    }
}

if (! function_exists('to_webp_url')) {
    /**
     * Convert an image URL or storage path to WebP if available.
     */
    function to_webp_url(?string $url): string
    {
        if (empty($url)) {
            return asset('assets/images/gedung-1.webp');
        }

        if (str_ends_with(strtolower($url), '.webp')) {
            return $url;
        }

        $webpUrl = preg_replace('/\.(jpe?g|png)$/i', '.webp', $url);

        // Check if local public asset or storage asset
        $parsed = parse_url($webpUrl, PHP_URL_PATH);
        if ($parsed && file_exists(public_path(ltrim($parsed, '/')))) {
            return $webpUrl;
        }

        return $url;
    }
}
