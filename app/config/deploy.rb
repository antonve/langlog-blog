set :stages,        %w(production)
set :default_stage, "production"
set :stage_dir,     "app/config"
require 'capistrano/ext/multistage'

set :application, "Langlog"
set :user, "deployer"
set :app_path,    "app"

set :scm,         :git
set :repository,  "git@github.com:antonve/langlog-blog.git"
set :deploy_via, :remote_cache
set :deploy_env, 'production'
set :branch,     "master"

before 'symfony:composer:install', 'composer:copy_vendors'
before 'symfony:composer:update', 'composer:copy_vendors'

namespace :composer do
  task :copy_vendors, :except => { :no_release => true } do
    run "vendorDir=#{current_path}/vendor; if [ -d $vendorDir ] || [ -h $vendorDir ]; then cp -a $vendorDir #{latest_release}/vendor; fi;"
  end
end

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,     [app_path + "/logs"]
set :use_composer, true
set :use_sudo, false
set :dump_assetic_assets, true
logger.level = Logger::MAX_LEVEL


set :model_manager, "doctrine"
# Or: `propel`
set  :keep_releases,  3

default_run_options[:pty] = true

set :writable_dirs,     ["app/cache", "app/logs"]
set :webserver_user,    "www-data"
set :permission_method, :chmod

after "deploy:update" do
  run "chmod -R 777 #{deploy_to}/current/app/cache #{deploy_to}/current/app/cache"
end
