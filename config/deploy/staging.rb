set :stage, :staging

# Deploy to Staging directory
set :deploy_to, "/home/#{fetch(:user)}/webapps/#{fetch(:application)}_staging"

# Sets branch to current one
set :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }

fetch(:default_env).merge!(wp_env: :staging)