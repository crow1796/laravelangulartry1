<?php

namespace App\FileManager\Downloader;

interface DownloaderContract {
	public function downloadFrom($entry, $from = '');
}