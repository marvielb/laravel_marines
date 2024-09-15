<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/marvielb/laravel_marines.git');
set('bin/composer', '/etc/profiles/per-user/{{remote_user}}/bin/composer');
set('bin/php', '/etc/profiles/per-user/{{remote_user}}/bin/php');
set('keep_releases', 1);

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts
host('aws.box') //set this in /etc/hosts
    ->set('remote_user', 'exam')
    ->set('port', 1023)
    ->set('deploy_path', '~/');

// Tasks
task('npm:build', function () {
    runLocally('nix develop --command bash -c "npm install"');
    runLocally('nix develop --command bash -c "npm run prod"');
    upload('./public/', '{{release_path}}/public');
})->desc('Build npm files locally');

// Hooks
after('deploy:vendors', 'npm:build');

after('deploy:failed', 'deploy:unlock');
