set :stage, :production

set :deploy_to, "/home/#{fetch(:user)}/webapps/#{fetch(:application)}_production"

fetch(:default_env).merge!(wp_env: :production)