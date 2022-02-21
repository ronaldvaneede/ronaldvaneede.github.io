---
extends: _layouts.post
section: content
title: Setting up a disposable development environment
author: Ronald van Eede
date: 2017-03-23
description: This is your first blog post.
cover_image: https://picsum.photos/seed/disposable/848/300
published: true
featured: true
categories: [Virtualbox,Vagrant,Ansible]
---

A problem with working on many different projects is that your computer can become littered with all kinds of libraries, frameworks, tools and applications that you only need for one project. Sometimes you can even have problems with conflicting versions, for example one project needs version x of a framework and another project needs version y of that same framework, but you can have only one installed at the same.

Sometimes you can resolve that by using [Node Version Manager](https://github.com/nvm-sh/nvm) for Nodejs or [Ruby Version Manager](https://rvm.io/) for Ruby for example. But that is not always possible.  
But after you stop working on that project and move on to another one that does not need those tools you still have them lingering around on your computer. You can of course uninstall them but who does that?

A solution would be to create a disposable, easily recreate-able virtual development environment for each project or different kind of project. In this post I will describe how you could to that.

## Tools you need

There are some tools you have to install:

* VirtualBox
* Vagrant
* Ansible

## Virtualbox

This is an application that you can use to run virtual machines on your computer.
Go to the [download page](https://www.virtualbox.org/wiki/Downloads) and download and install the correct version for your operating system.

## Vagrant

This tool works together with Virtualbox and makes it possible to easily create, start, provision, stop and destroy virtual machines and is often used to create disposable development environments.  
Go to the [downloads page](https://www.vagrantup.com/downloads) and download and install the correct version for your operating system.
Ansible

## Ansible

Ansible is a tool that can be used to provision one or more computers with the tools and software that is needed. This is done by describing the steps to install those in a tasks that are referred to in a playbook.

Ansible cannot run from windows, it should be possible to use it from a Cygwin terminal but I had too many issues to get that working. For windows I use a workaround I will describe later. If you use OS X or Linus you can install Ansible on your computer.

Go to the [downloads page](https://docs.ansible.com/ansible/intro_installation.html#installing-the-control-machine) and download and install the correct version for your operating system.

When you have those two or three tools installed you can continue.

## Project setup

First create a directory for your project. Within that directory create another directory where you would place the source code of your application, for example `source`.  
Then within your project directory create file named `Vagrantfile` and put this in the file:

```ruby
# -*- mode: ruby -*-
# vi: set ft=ruby :
require 'yaml'# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.network "private_network", ip: "192.168.33.10"
  config.vm.synced_folder "/source", "/home/vagrant/source"config.vm.provider "virtualbox" do |vb|
    vb.name = "development"
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end# you can remove this on OS X and Linux environments if you installed Ansible and enable the piece of code below.
  config.vm.provision :shell,
    :keep_color =&gt; true,
    :inline =&gt; "export PYTHONUNBUFFERED=1 && export ANSIBLE_FORCE_COLOR=1 && cd /vagrant && ./init.sh"
  
  # this is not working on windows environments, so for now using above workaround
  # config.vm.provision "ansible" do |ansible|
  #   ansible.playbook = "playbook.yml"
  # end
end
```

For the Windows users, create a file named `init.sh` with this content (OS X and Linux users can skip this step):

```bash
#!/bin/bash

if [ $(dpkg-query -W -f='${Status}' ansible 2>/dev/null | grep -c "ok installed") -eq 0 ];
then
    echo "Add APT repositories"
    export DEBIAN_FRONTEND=noninteractive
    apt-get install -qq software-properties-common &> /dev/null || exit 1
    apt-add-repository ppa:ansible/ansible &> /dev/null || exit 1apt-get update -qqecho "Installing Ansible"
    apt-get install -qq ansible &> /dev/null || exit 1
    echo "Ansible installed"
ficd /vagrant
ansible-playbook -K playbook.yml --connection=local
```

_Make sure this file has unix line endings._

You can use Notepad++ to set the correct line endings but most other text editors should also be able to do this.  
This wil will be executed during the provisioning phase and will install Ansible on the virtual machine and then run the Ansible playbook.

Next we will create the playbook file, create a file named `playbook.yml` in the project directory.

```yaml
---
- hosts: localhost
  user: vagrant
  roles:
    - essentials
    - apache
```

In this file we will define the roles that you want your environment to fulfill. Later we will define those roles.  
Now we have to create a directory structure than Ansible understands so it can find the rest of the configuration.

First you have to create a `roles` directory within your project folder. In that roles directory you then create a directory for each role. 
So in my example you would create a directory `essentials` and `apache`.  
Now within each of those directories you have to create a `tasks` directory so you would get this structure:

```
/project/Vagrantfile
/project/init.sh
/project/playbook.yml
/project/source/
/project/roles/essentials/
/project/roles/apache/
```

In the `essentials` folder we now create a `main.yml` file to define the tasks that are needed to install the essentials on the virtual machine.

```yaml
- name: Update APT package cache
  sudo: yes
  apt: update_cache=yes

- name: Install essentials
  sudo: yes
  apt: name="{{item}}" state=present
  with_items:
    - python-software-properties
    - python-pycurl
    - build-essential
    - curl
    - git-core
    - unzip
    - dos2unix
```

This will update the apt-get cache and then install a bunch of useful tools and libraries.

And in the `apache` folder we create a `main.yml` file to define the tasks that are needed to install apache on the virtual machine.

```
# Apache- name: Install Apache
  sudo: yes
  apt: name="{{item}}" state=present
  with_items:
    - apache2
    
- name: Start the Apache service
  sudo: yes
  action: service name=apache2 state=started
  
- name: Enable mod_rewrite
  apache2_module: name=rewrite state=present
  
- name: Enable mod_proxy
  apache2_module: name=proxy state=present
  
- name: Enable mod_proxy_balancer
  apache2_module: name=proxy_balancer state=present
  
- name: Enable mod_proxy_http
  apache2_module: name=proxy_http state=present
  
- name: Enable mod_lbmethod_byrequests
  apache2_module: name=lbmethod_byrequests state=present
  
- name: Enable mod_ssl
  apache2_module: name=ssl state=present
  notify:
    - restart apache2
```

This task will install Apache2 with apt-get, install some modules and restart the Apache2 service.
To restart the Apache2 service we call a handler that we have to create.  
So to do this create a `handlers` folder in the `apache` folder and create a main.yml file with this content:

```
- name: restart apache2
  service: name=apache2 state=restarted
```

So now you should have this directory and file structure:

```
/project/Vagrantfile
/project/init.sh
/project/playbook.yml
/project/source/
/project/roles/essentials/tasks/main.yml
/project/roles/apache/tasks/main.yml
/project/roles/apache/handlers/main.yml
```

## Vagrant

Now we are all set up we can start and provision the virtual machine.

Open the command line and go to your project folder and then run the `vagrant up` command.
The first time you do this Vagrant will first download the ubuntu/trusty64 base box if you do not already have it. This might take a while but once you have it you can reuse it for other projects.  
After the base box is downloaded vagrant will configure it in Virtualbox and start it. when it is booted it will be provisioned according the the Ansible playbook we created before.  
Once it's all finished you will have a basic virtual development environment ready with some essential tools and libraries installed and Apache.

Other commands that you can use to control your virtual development environment are:  

- `vagrant reload` to restart the virtual environment
- `vagrant halt` to stop the virtual environment
- `vagrant destroy` to destroy the virtual environment
- `vagrant provision` to (re)provision the virtual environment
- `vagrant ssh` to open an ssh terminal to the virtual environment

In another future post I will explain some more about using Vagrant and I will extend the playbook with some more roles.