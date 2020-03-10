<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/yarn.php';

// Project name
set('application', 'dashboard');
set('http_user', 'travia');
set('bin/yarn', '~/bin/yarn');

// Project repository
set('repository', 'git@github.com:obstschale/dashboard.spatie.be.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

set('branch', 'private');

// Hosts

host('travia')
    ->stage('production')
    ->configFile('~/.ssh/config')
    ->set('deploy_path', '~/html/{{application}}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('php:restart', function () {
    run('uberspace tools restart php');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

desc('Build Yarn for production');
task('yarn:production', function () {
    run("cd {{release_path}} && {{bin/yarn}} production");
});

after('deploy:update_code', 'yarn:install');
after('yarn:install', 'yarn:production');
after('artisan:migrate', 'php:restart');

