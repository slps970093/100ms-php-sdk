<?php

// 設定要檢查的目錄
$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12' => true, // 使用 PSR-12 的程式碼風格標準
    'strict_param' => true, // 開啟嚴格模式，禁止 PHP 自行轉換類型
    'array_syntax' => ['syntax' => 'short'], // 陣列宣告使用
])
    ->setFinder($finder);