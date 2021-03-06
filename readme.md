#####################################################VOYAGER

[![Go Report Card](https://goreportcard.com/badge/voyagermesh.dev/voyager)](https://goreportcard.com/report/voyagermesh.dev/voyager)
[![Build Status](https://github.com/voyagermesh/voyager/workflows/CI/badge.svg)](https://github.com/voyagermesh/voyager/actions?workflow=CI)
[![codecov](https://codecov.io/gh/voyagermesh/voyager/branch/master/graph/badge.svg)](https://codecov.io/gh/voyagermesh/voyager)
[![Docker Pulls](https://img.shields.io/docker/pulls/appscode/voyager.svg)](https://hub.docker.com/r/appscode/voyager/)
[![Slack](https://slack.appscode.com/badge.svg)](https://slack.appscode.com)
[![Twitter](https://img.shields.io/twitter/follow/voyagermesh.svg?style=social&logo=twitter&label=Follow)](https://twitter.com/intent/follow?screen_name=voyagermesh)

> Secure HAProxy Ingress Controller for Kubernetes

Voyager is a [HAProxy](http://www.haproxy.org/) backed [secure](#certificate) L7 and L4 [ingress](#ingress) controller for Kubernetes developed by [AppsCode](https://appscode.com). This can be used with any Kubernetes cloud providers including aws, gce, gke, azure, acs. This can also be used with bare metal Kubernetes clusters.

## Ingress
Voyager provides L7 and L4 loadbalancing using a custom Kubernetes [Ingress](https://voyagermesh.com/docs/latest/guides/ingress/) resource. This is built on top of the [HAProxy](http://www.haproxy.org/) to support high availability, sticky sessions, name and path-based virtual hosting.
This also support configurable application ports with all the options available in a standard Kubernetes [Ingress](https://kubernetes.io/docs/concepts/services-networking/ingress/).

## Certificate
Voyager can automatically provision and refresh SSL certificates (including wildcard certificates) issued from Let's Encrypt using a custom Kubernetes [Certificate](https://voyagermesh.com/docs/latest/guides/certificate/) resource.

## Supported Versions
Please pick a version of Voyager that matches your Kubernetes installation.

| Voyager Version                                                                      | Docs                                                                 | Kubernetes Version | Prometheus operator Version |
|--------------------------------------------------------------------------------------|----------------------------------------------------------------------|--------------------|-----------------------------|
| [v13.0.0-beta.1](https://github.com/voyagermesh/voyager/releases/tag/v13.0.0-beta.1) | [User Guide](https://voyagermesh.com/docs/v13.0.0-beta.1/)           | 1.14.x+            | 0.34.0+                     |
| [v12.0.0](https://github.com/voyagermesh/voyager/releases/tag/v12.0.0)               | [User Guide](https://voyagermesh.com/docs/v12.0.0/)                  | 1.11.x - 1.17.x    | 0.34.0+                     |
| [v11.0.1](https://github.com/voyagermesh/voyager/releases/tag/v11.0.1)               | [User Guide](https://voyagermesh.com/docs/v11.0.1/)                  | 1.9.x+             | 0.30.0+                     |
| [10.0.0](https://github.com/voyagermesh/voyager/releases/tag/10.0.0)                 | [User Guide](https://voyagermesh.com/docs/10.0.0/)                   | 1.9.x+             | 0.16.0+                     |
| [7.4.0](https://github.com/voyagermesh/voyager/releases/tag/7.4.0)                   | [User Guide](https://voyagermesh.com/docs/7.4.0/)                    | 1.8.x - 1.11.x     | 0.16.0+                     |
| [5.0.0](https://github.com/voyagermesh/voyager/releases/tag/5.0.0)                   | [User Guide](https://voyagermesh.com/docs/5.0.0/)                    | 1.7.x              | 0.12.0+                     |

## Installation
To install Voyager, please follow the guide [here](https://voyagermesh.com/docs/latest/setup/install/).

## Using Voyager
Want to learn how to use Voyager? Please start [here](https://voyagermesh.com/docs/latest/welcome/).

## Voyager API Clients
You can use Voyager api clients to programmatically access its CRD objects. Here are the supported clients:

- Go: [https://github.com/voyagermesh/voyager](/client/clientset/versioned)
- Java: https://github.com/voyagermesh/java

## Contribution guidelines
Want to help improve Voyager? Please start [here](https://voyagermesh.com/docs/latest/welcome/contributing/).

---

**Voyager binaries collects anonymous usage statistics to help us learn how the software is being used and how we can improve it.
To disable stats collection, run the operator with the flag** `--enable-analytics=false`.

---

## Acknowledgement
 - docker-library/haproxy https://github.com/docker-library/haproxy
 - kubernetes/contrib https://github.com/kubernetes/contrib/tree/master/service-loadbalancer
 - kubernetes/ingress https://github.com/kubernetes/ingress
 - xenolf/lego https://github.com/appscode/lego
 - kelseyhightower/kube-cert-manager https://github.com/kelseyhightower/kube-cert-manager
 - PalmStoneGames/kube-cert-manager https://github.com/PalmStoneGames/kube-cert-manager
 - [Kubernetes cloudprovider implementation](https://github.com/kubernetes/kubernetes/tree/master/pkg/cloudprovider)
 - openshift/generic-admission-server https://github.com/openshift/generic-admission-server
 - TimWolla/haproxy-auth-request https://github.com/TimWolla/haproxy-auth-request

## Support

We use Slack for public discussions. To chit chat with us or the rest of the community, join us in the [AppsCode Slack team](https://appscode.slack.com/messages/C0XQFLGRM/details/) channel `#general`. To sign up, use our [Slack inviter](https://slack.appscode.com/).

If you have found a bug with Voyager or want to request for new features, please [file an issue](https://github.com/voyagermesh/voyager/issues/new).

#####################################################LARAVEL 
<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# itime

