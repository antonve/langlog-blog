server 'antonve.be', :app, :web, :primary => true

set :domain,      "langlog.be"
set :deploy_to,   "/var/www/#{domain}"
