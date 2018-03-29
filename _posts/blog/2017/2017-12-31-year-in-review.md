---
title: "2017: Year In Review 🎈"
category: blog
layout: post
---

Keeping on the spirit of yearly reviews, here's 2017's review! 😅 [Last year my
focus was on ramping up knowledge on devops tooling and services][2016-review].
This year, it's clear that the focus was on [Kubernetes][kubernetes] and the
community around it.

I achieved every goal I'd set for myself for 2017 except [publishing the stuff I
learnt][publish-learning]. 😓 Hopefully I'll improve on that in 2018.

### Conferences 📝

1. [DevOps Days Cape Town](https://www.devopsdays.org/events/2017-cape-town/welcome/) (6th-7th November)
2. [KubeCon + CloudNativeCon North America](https://events17.linuxfoundation.org/events/kubecon-and-cloudnativecon-north-america) (6th-8th December)

### Talks 🎤

* 5 Things I Wish I Knew Before Moving To Kubernetes ([slides][talk-1-slides]/[talk][talk-1-video])

[talk-1-slides]: https://speakerdeck.com/itskingori/5-things-i-wish-i-knew-before-moving-to-kubernetes
[talk-1-video]: https://youtu.be/jVqiZY1wYBs

### Open Source 💻

**Community:**

* Joined the [Kubernetes organisation on GitHub](https://github.com/kubernetes)
* Joined the [Kubernetes developers Google Group](https://groups.google.com/forum/#!forum/kubernetes-dev)

**Notable libraries/binaries:**

* [go-wkhtml](https://github.com/itskingori/go-wkhtml) - Golang wrapper for
  `wkhtmltopdf` and `wkhtmltoimage`.
* [sanaa](https://itskingori.github.io/sanaa) - A HTML to PDF/Image conversion
  service available over a HTTP API and powered by `wkhtmltopdf` and
  `wkhtmltoimage`.

**Notable PRs:**

* [kopeio/kubernetes-kernel#8](https://github.com/kopeio/kubernetes-kernel/pull/8)  
  Update kernel to 4.4.78 and mark new packages for use
* [kubernetes/kops#3942](https://github.com/kubernetes/kops/pull/3942)  
  Add comprehensive horizontal pod autoscaling documentation
* [kubernetes/kops#13230](https://github.com/kubernetes/kops/pull/13230)  
  Generate default bastion public DNS name from dns zone
* [kubernetes/kube-deploy#289](https://github.com/kubernetes/kube-deploy/pull/289)  
  Improve imagebuilder setup and documentation
* [tcnksm/go-input#15](https://github.com/tcnksm/go-input/pull/15)  
  Avoid adding newlines to output by default

**Notable Issues:**

* [influxdata/telegraf#2233](https://github.com/influxdata/telegraf/issues/2233)  
  Context deadline exceeded error with Docker plugin
* [kaminari/kaminari#915](https://github.com/kaminari/kaminari/issues/915)  
  Page per() method not working as intended
* [kubernetes/kops#2928](https://github.com/kubernetes/kops/issues/2928)  
  Unstable Kubernetes v1.6.6 cluster created with Kops 1.6.2
* [kubernetes/kops#1322](https://github.com/kubernetes/kops/issues/1322)  
  Default bastion public DNS name should be generated from dns zone
* [kubernetes/kops#1415](https://github.com/kubernetes/kops/issues/1415)  
  Error creating cluster: "found duplicate tasks with name"

### The Next 8,760 Hours 🎯

* [Read more books][reading-list].
* [Write more about the things that I learn][publish-learning].
* Give a talk at a conference (at a minimum, a lightning talk).
* Keeping getting more stuff out (and keeping a better record of it) for a
  better "2018: Year In Review". ;-)

[2016-review]: /blog/2016/12/year-in-review/
[kubernetes]: https://kubernetes.io
[reading-list]: /about/reading-list
[publish-learning]: /articles/2013/06/publish-what-you-learn/
