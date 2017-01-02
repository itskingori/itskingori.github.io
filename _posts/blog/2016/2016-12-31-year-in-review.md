---
title: "2016: Year In Review 🎉"
category: blog
layout: post
---

Inspired by [Julia Evan's own "2016: Year In Review"][jvns-2016] ... this is the
start of an archive/reflection of sorts that I hope to get into the habit of
writing down every year's end. It focuses on career growth and avoids the
personal stuff.

### Conferences 📝

1. [Rubyfuza](http://www.rubyfuza.org/2016.html) (4th-5th February)
2. [DevOps Days Cape Town](https://www.devopsdays.org/events/2016-capetown/welcome/) (7th-8th November)

### Open Source 💻

* [Found a bug and filed an issue][link-1] in the [@kubernetes/kops][link-2]
  project and eventually managed to [submit a PR with a fix][link-3]. 🏆
* [Filed an interesting issue with `osxfs`][link-6] in the [@docker/for-
  mac][link-7] project. Didn't find a fix, but at least [I was able to find a
  temporary solution to get us going][link-12].
* Started a new Ruby gem, `mpesa` ([@itskingori/mpesa-gem][link-4]) which
  attempts to make it dead easy to interact with the [M-Pesa G2 API][link-5] in
  Ruby (WIP).
* Open sourced [zappi/oauth2_proxy][link-8], one of the docker images we use [at
  work][zappistore].

### Toolset 🛠

Last year I got started with DevOps sometime in October and I hit the ground
running with:

* ELK+F stack - centralise log collection for easier and fast debugging using:
  * [Elasticsearch][elasticsearch] – stores and indexes logs.
  * [Logstash][logstash] – parses, stores and indexes logs.
  * [Kibana][kibana] – dashboard to access logs in Elasticsearch e.g. search.
  * [Filebeat][filebeat] – ships logs to Logstash.
* TIG stack - centralise metric collection, also for easier and faster debugging
  using:
  * [Telegraf][telegraf] – ships metrics to InfluxDB.
  * [Grafana][grafana] – dashboard to access metrics stored in InfluxDB.
  * [InfluxDB][influxdb] - stores and indexes metrics.
* [Chef][chef] – automation solution for both infrastructure and applications
* [Docker][docker] – encapsulate applications securely isolated in a container,
  packaged with all its dependencies and libraries.
* [Elastic Container Service][ecs] (ECS) –  Amazon's container management
  service on AWS that supports Docker containers and allows you to run
  applications on a managed cluster of Amazon EC2 instances.

This year I maintained that momentum mostly by building upon the foundation laid
in Oct-Dec last year:

* [Ansible][ansible] – automation engine that automates cloud provisioning,
  configuration management, and application deployment.
* [Kubernetes][kubernetes] – platform for automating deployment, scaling, and
  operations of application containers across clusters of hosts, providing
  container-centric infrastructure.
* [Kubernetes-Kops][kubernetes-kops] – tool to deploy Kubernetes clusters from
  the command line, with options that support H/A masters (on AWS).
* [Terraform][terraform] – tool for building, changing, and versioning
  infrastructure safely and efficiently.

I've also gotten way way *way* better at:

[Access Control][computer-access-control] • [Amazon AWS][aws] • [Bash][bash] • [Continuous Deployment][continuous-deployment] • [Continuous Integration][continuous-integration] • [Git][git] • [Linux][linux] • [Networking][computer-networking] • [Python][python] • [Ruby][ruby]+[Rails][rails] • [Security][computer-security]

### The Next 8,760 Hours 🎯

* [Read more books][link-9].
* [Write more about the things that I learn][link-10].
* Give a talk at a conference (at a minimum, a lightning talk).
* Get way more stuff out (and keep a better record of it) for a better "2017:
  Year In Review". ;-)

---

1. I learnt a lot more than what's listed here. Unfortunately I didn't blog much
   this year so this is really the best attempt at capturing the highlights that
   I remember.
2. I'm not at liberty to share some of the details of the stuff I work on.
   There's a lot of fun stuff that I got exposed to so that cuts out another big
   chunk! Hopefully, we'll be able to set up an engineering blog to formally
   share work stories.

[link-1]: https://github.com/kubernetes/kops
[link-2]: https://github.com/kubernetes/kops/issues/1246
[link-3]: https://github.com/kubernetes/kops/pull/1250
[link-4]: https://github.com/kubernetes/kops
[link-5]: http://www.safaricom.co.ke/business/corporate/m-pesa-payments-services/m-pesa-api
[link-6]: https://github.com/docker/for-mac/issues/320
[link-7]: https://github.com/docker/for-mac
[link-8]: https://hub.docker.com/r/zappi/oauth2_proxy/
[link-9]: /about/reading-list
[link-10]: /articles/2013/06/publish-what-you-learn/
[link-12]: https://github.com/docker/for-mac/issues/320#issuecomment-240695160

[ansible]: https://docs.ansible.com/ansible/index.html
[aws]: https://aws.amazon.com
[bash]: https://www.gnu.org/software/bash/
[chef]: https://docs.chef.io
[computer-access-control]: https://en.wikipedia.org/wiki/Computer_access_control
[computer-networking]: https://en.wikipedia.org/wiki/Computer_network
[computer-security]: https://en.wikipedia.org/wiki/Computer_security
[continuous-deployment]: https://en.wikipedia.org/wiki/Continuous_deployment
[continuous-integration]: https://en.wikipedia.org/wiki/Continuous_integration
[docker]: https://docs.docker.com
[ecs]: https://aws.amazon.com/ecs/
[elasticsearch]: https://www.elastic.co/guide/en/elasticsearch/reference/current/index.html
[filebeat]: https://www.elastic.co/guide/en/beats/filebeat/current/index.html
[git]: https://git-scm.com/documentation
[grafana]: http://docs.grafana.org
[influxdb]: https://docs.influxdata.com/influxdb/
[jvns-2016]: http://www.jvns.ca/blog/2016/12/21/2016--year-in-review/
[kibana]: https://www.elastic.co/guide/en/kibana/current/index.html
[kubernetes]: http://kubernetes.io/docs/
[kubernetes-kops]: https://github.com/kubernetes/kops#kubernetes-operations-kops
[linux]: https://en.wikipedia.org/wiki/Linux
[logstash]: https://www.elastic.co/guide/en/logstash/current/index.html
[python]: https://docs.python.org
[rails]: http://guides.rubyonrails.org
[ruby]: http://ruby-doc.org
[telegraf]: https://docs.influxdata.com/telegraf/
[terraform]: https://www.terraform.io/docs/index.html
[zappistore]: http://zappistore.com/

