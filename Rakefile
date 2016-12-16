require 'html-proofer'

task :test do
  puts "\n## Generating Site with Jekyll"
  system "bundle exec jekyll build"

  puts "\n## HTML Proofing the generated site"
  HTMLProofer.check_directory('./_site',
    alt_ignore: [/.*/],
    disable_external: true,
    assume_extension: true).run
end
