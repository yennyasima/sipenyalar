<?php

namespace App\Helpers;

use Exception;

class Helper
{
    /**
     * Get the correct Vite-built asset path from manifest.
     *
     * @param string $path
     * @return string
     * @throws Exception
     */
    public static function viteAsset($path)
    {
        // Jalur ke file manifest Vite di folder build
        $manifestPath = public_path('build/manifest.json');

        // Cek apakah file manifest ada
        if (!file_exists($manifestPath)) {
            throw new Exception('The Vite manifest file does not exist.');
        }

        // Baca file manifest dan decode isinya
        $manifest = json_decode(file_get_contents($manifestPath), true);

        // Cek apakah aset yang diminta ada di dalam manifest
        if (!array_key_exists($path, $manifest)) {
            throw new Exception("The asset '{$path}' is not present in the Vite manifest.");
        }

        // Kembalikan jalur file yang sudah dibuild
        return asset('build/' . $manifest[$path]['file']);
    }
}
