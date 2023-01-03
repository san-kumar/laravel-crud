<?php

$config = preg_replace('/.*sidebar/ms', '', file_get_contents('.vitepress/config.js'));

if (preg_match_all("#link: '(.*)'#", $config, $matches)) {

    foreach ((array) $matches[1] as $link) {
        if (is_file($file = realpath(__DIR__ . "$link.md") ?: realpath(__DIR__ . "/$link/index.md"))) {
            $md[] = file_get_contents($file);
        }
    }
}

if (!empty($md)) {
    $content = implode("\n", $md);
    $docs = "> ## Please see the [**full documentation here**](https://san-kumar.github.io/laravel-crud/).\n\n";
    $content = preg_replace("/## Introduction\n/", "## Introduction\n\n" . file_get_contents(__DIR__ . '/badges.md') . "\n\n$docs", $content);
    $content = preg_replace_callback("/:::warning(.*?):::/ms", fn($match) => "> " . join("\n> ", explode("\n", $match[1])), $content);
    $content = preg_replace("#\(/guide#", "(https://san-kumar.github.io/laravel-crud/guide", $content);

    file_put_contents(__DIR__ . '/../README.md', $content);
} else {
    echo "No files found";
}
