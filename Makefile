SHELL := /bin/bash

install:
	bundle install

server:
	bundle exec jekyll serve --watch --safe --trace

test_html_proofer:
	bundle exec rake html_proofer
