SHELL := /bin/bash

install:
	bundle install

server:
	bundle exec jekyll serve --watch --safe --trace

test:
	bundle exec rake test
