<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OptimizeImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:optimize-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert public and uploaded images to WebP format and optimize file sizes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting WebP Image Optimization...');

        $directories = [
            public_path('assets/images'),
            storage_path('app/public'),
        ];

        $totalOriginalSize = 0;
        $totalWebpSize = 0;
        $convertedCount = 0;

        foreach ($directories as $dir) {
            if (!File::isDirectory($dir)) {
                continue;
            }

            $files = File::allFiles($dir);

            foreach ($files as $file) {
                $ext = strtolower($file->getExtension());
                if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                    continue;
                }

                $sourcePath = $file->getRealPath();
                $webpPath = pathinfo($sourcePath, PATHINFO_DIRNAME) . '/' . pathinfo($sourcePath, PATHINFO_FILENAME) . '.webp';

                // Check if webp already exists and source hasn't changed
                if (File::exists($webpPath) && File::lastModified($webpPath) >= File::lastModified($sourcePath)) {
                    continue;
                }

                $image = null;
                if ($ext === 'jpg' || $ext === 'jpeg') {
                    $image = @imagecreatefromjpeg($sourcePath);
                } elseif ($ext === 'png') {
                    $image = @imagecreatefrompng($sourcePath);
                    if ($image) {
                        imagepalettetotruecolor($image);
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                    }
                }

                if ($image) {
                    // Check if width is excessively large (e.g. > 1920px), resize down proportionally
                    $origWidth = imagesx($image);
                    $origHeight = imagesy($image);

                    if ($origWidth > 1920) {
                        $newWidth = 1920;
                        $newHeight = (int) round(($origHeight / $origWidth) * $newWidth);
                        $resized = imagecreatetruecolor($newWidth, $newHeight);
                        imagealphablending($resized, false);
                        imagesavealpha($resized, true);
                        imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                        imagedestroy($image);
                        $image = $resized;
                    }

                    $quality = 82;
                    imagewebp($image, $webpPath, $quality);
                    imagedestroy($image);

                    $origSize = filesize($sourcePath);
                    $webpSize = filesize($webpPath);

                    $totalOriginalSize += $origSize;
                    $totalWebpSize += $webpSize;
                    $convertedCount++;

                    $savedPercent = round((1 - ($webpSize / $origSize)) * 100, 1);
                    $this->line("Converted: {$file->getFilename()} (" . round($origSize / 1024) . " KB) -> " . pathinfo($webpPath, PATHINFO_BASENAME) . " (" . round($webpSize / 1024) . " KB) [Saved {$savedPercent}%]");
                }
            }
        }

        $this->newLine();
        $this->info("Successfully converted {$convertedCount} images to WebP.");
        if ($totalOriginalSize > 0) {
            $totalSavedMB = round(($totalOriginalSize - $totalWebpSize) / 1024 / 1024, 2);
            $totalSavedPercent = round((1 - ($totalWebpSize / $totalOriginalSize)) * 100, 1);
            $this->info("Total bandwidth savings: {$totalSavedMB} MB saved ({$totalSavedPercent}% reduction)!");
        }

        return Command::SUCCESS;
    }
}
