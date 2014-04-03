require 'sprockets'

# Get relevant paths
project_root = File.expand_path('..', File.dirname(__FILE__))
app_css_file = File.join(project_root, 'assets', 'stylesheets', 'application.css')
app_js_file  = File.join(project_root, 'assets', 'javascripts', 'application.js')

environment = Sprockets::Environment.new
environment.append_path(File.join(project_root, '_assets', 'javascripts'))
environment.append_path(File.join(project_root, '_assets', 'stylesheets'))

environment.js_compressor  = :uglifier
environment.css_compressor = :yui

File.open(app_css_file, 'w') { |f| f.write environment['application.css'].to_s }
File.open(app_js_file,  'w') { |f| f.write environment['application.js'].to_s }
