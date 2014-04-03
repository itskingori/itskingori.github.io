---
title: Minify Jekyll Assets On GitHub Pages Using Sprockets
category: minutae
layout: post
---

While there are [Jekyll plugins][2] to minify assets just like the [Rails Asset
Pipeline][3], GitHub generates sites using the `--safe` option to disable custom
plugins for security reasons. This means that those plugins won’t work.

However, you could store some assets in `_assets/`, run the
`_build/preprocess_assets.rb` script below to generate the minified files in
`assets`.

```ruby
require 'sprockets'

# Get relevant paths
project_root = File.expand_path('..', File.dirname(__FILE__))
app_css_file = File.join(project_root, 'assets', 'stylesheets', 'application.css')
app_js_file  = File.join(project_root, 'assets', 'javascripts', 'application.js')

# Initialize Sprockets
environment = Sprockets::Environment.new
environment.append_path(File.join(project_root, '_assets', 'javascripts'))
environment.append_path(File.join(project_root, '_assets', 'stylesheets'))

# Set configuration
environment.js_compressor  = :uglifier
environment.css_compressor = :yui

# Write minifies JS & CSS into files
File.open(app_css_file, 'w') { |f| f.write environment['application.css'].to_s }
File.open(app_js_file,  'w') { |f| f.write environment['application.js'].to_s }

# See; https://gist.github.com/itsmrwave/9954229

```

Then push to GitHub. Comment, discuss or view this script [here][1].

[1]: https://gist.github.com/itsmrwave/9954229
[2]: http://jekyllrb.com/docs/plugins/
[3]: http://guides.rubyonrails.org/asset_pipeline.html
[4]: http://jekyllrb.com
