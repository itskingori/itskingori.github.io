require 'html-proofer'

task :test do
  puts "\n## Generating Site with Jekyll"
  system "bundle exec jekyll build"

  puts "\n## HTML Proofing the generated site"
  HTMLProofer.check_directory('./_site',
    assume_extension: '.html',
    ignore_missing_alt: true,
    disable_external: true,
    enforce_https: false).run
end
