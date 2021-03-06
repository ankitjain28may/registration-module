

# Registration-Module

[![Build Status](https://travis-ci.org/ankitjain28may/registration-module.svg?branch=master)](https://travis-ci.org/ankitjain28may/registration-module)
[![Build Status](https://status.continuousphp.com/git-hub/ankitjain28may/registration-module?token=bc2756bb-c28b-4896-a3cb-ca62ef41f3cb&branch=master)](https://continuousphp.com/git-hub/ankitjain28may/registration-module)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ankitjain28may/registration-module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ankitjain28may/registration-module/?branch=master)
[![Code Climate](https://codeclimate.com/github/ankitjain28may/registration-module/badges/gpa.svg)](https://codeclimate.com/github/ankitjain28may/registration-module)
[![Coverage Status](https://coveralls.io/repos/github/ankitjain28may/registration-module/badge.svg?branch=master)](https://coveralls.io/github/ankitjain28may/registration-module?branch=master)
[![Issue Count](https://codeclimate.com/github/ankitjain28may/registration-module/badges/issue_count.svg)](https://codeclimate.com/github/ankitjain28may/registration-module)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/2bc923721c91432189acbd9f4b2925c4)](https://www.codacy.com/app/ankitjain28may77/registration-module?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=ankitjain28may/registration-module&amp;utm_campaign=Badge_Grade)
[![npm](https://img.shields.io/npm/dt/registration-module.svg?style=flat-square)](https://www.npmjs.com/package/registration-module)
[![Packagist](https://img.shields.io/packagist/dt/registration-module/module.svg?style=flat-square)](https://packagist.org/packages/registration-module/module)

> It is an open source module to integrate a login-registration part in your projects. It is completely integrated through ajax and js so you do not need to reload page whenever it sends a request, everything is done for you.


# How to Setup
> Setting up on your local machine is really easy. Follow this guide to setup your development machine.

### Requirements :

1. PHP > 5.6
2. MySQL
3. Composer or npm or git

### Installation :

1. Get the source code on your machine via git.

    ```shell
    git clone https://github.com/ankitjain28may/registration-module.git
    ```
    Or
    ```json
        "require" : {
        "registration-module/module" : "dev-master"
        }
    ```
    Or
    ```shell
        npm install registration-module
    ```

2. Rename `config\database.example.php` to `config\database.php` and Change credential in `config\database.php`

3. Create an empty sql database and run import database.

    ```mysql
    create database [database name];
    mysql -u[user] -p [password] [database name] < path\sql\registration-module.sql
    ```

4. Open a new terminal window and type

    ```php
    php -S localhost:8080
    ```
That's it, Now start development at [http://localhost:8080](http://localhost:8080) in your browser

## Contribution guidelines

If you are interested in contributing to OpenChat, Open Issues and send PR.
> Feel free to code and contribute

>Made By - Ankit Jain
