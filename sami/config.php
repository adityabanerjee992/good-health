<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Resources')
    ->exclude('Tests')
    ->in($dir = 'app/Http/Controllers')
;

// generate documentation for all v2.0.* tags, the 2.0 branch, and the master one
// $versions = GitVersionCollection::create($dir)
//     ->addFromTags('v2.0.*')
//     ->add('2.0', '2.0 branch')
//     ->add('master', 'master branch')
// ;

return new Sami($iterator, array(
    // 'theme'                => 'symfony',
    // 'versions'             => $versions,
    'title'                => 'Goodhealth Code Document',
    'build_dir'            => __DIR__.'/build',
    'cache_dir'            => __DIR__.'/cache',
   'default_opened_level' => 2,
    // 'remote_repository' => new GitHubRemoteRepository('laravel/framework', dirname($dir)),
));