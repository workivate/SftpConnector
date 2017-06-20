#!/usr/bin/env php
<?php

chdir(dirname(__DIR__));

function abort($message)
{
    fwrite(STDERR, $message);

    exit(1);
}

function showUsage()
{
    global $argv;

    abort("Usage: \"$argv[0]\" <repository url|organization <repository name>>");
}

if ($argc < 2 || (!preg_match('[//github.com/([^/]+)/([^/]+)]', $argv[1], $matches) && $argc < 3)) {
    showUsage();
}

list($_, $organization, $repository) = $matches ?: $argv;

$repoResponse = file_get_contents(
    "https://api.github.com/repos/$organization/$repository",
    false,
    $context = stream_context_create([
        'http' => [
            'header' => 'Accept: application/vnd.github.v3.raw+json',
            'user_agent' => 'ScriptFUSION',
        ],
    ])
);
$repo = json_decode($repoResponse, true);

$composerResponse = file_get_contents(
    file_exists($file = 'composer.json')
        ? $file
        : "https://api.github.com/repos/$organization/$repository/contents/$file",
    false,
    $context
);

$composer = json_decode($composerResponse, true);

$title = strtr($repo['name'], '-', ' ');
$underline = str_repeat('=', strlen($title));
$name = $repo['full_name'];
$cname = $composer['name'];
$id = $repo['id'];

echo <<<_
$title
$underline

[![Latest version][Version image]][Releases]
[![Total downloads][Downloads image]][Downloads]
[![Build status][Build image]][Build]
[![Test coverage][Coverage image]][Coverage]
[![Code style][Style image]][Style]

&lt;INSERT CONTENT HERE>


  [Releases]: https://github.com/$name/releases
  [Version image]: https://poser.pugx.org/$cname/version "Latest version"
  [Downloads]: https://packagist.org/packages/$cname
  [Downloads image]: https://poser.pugx.org/$cname/downloads "Total downloads"
  [Build]: https://travis-ci.org/$name
  [Build image]: https://travis-ci.org/$name.svg?branch=master "Build status"
  [Coverage]: https://coveralls.io/github/$name
  [Coverage image]: https://coveralls.io/repos/$name/badge.svg "Test coverage"
  [Style]: https://styleci.io/repos/$id
  [Style image]: https://styleci.io/repos/$id/shield?style=flat "Code style"
_;
