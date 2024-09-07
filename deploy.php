<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/marvielb/laravel_marines.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

task('npm:build', function () {
    run('cd {{release_path}} && npm install');
    run('cd {{release_path}} && npm run prod');
})->desc('Compile npm files locally');

// Hosts
host('exam.marvielb.com')
    ->set('remote_user', 'exam')
    ->set('port', 1023)
    ->set('deploy_path', '~/');

// Hooks
after('deploy:update_code', function () {
    $file_contents = file_get_contents('./.env', FILE_TEXT);
    run('touch ./shared/.env');
    run("echo '{$file_contents}' > ./shared/.env");
});

after('deploy:vendors', function () {
    run('cd release && composer install');
});
after('deploy:vendors', 'npm:build');

after('deploy:failed', 'deploy:unlock');
