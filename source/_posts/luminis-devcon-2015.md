---
extends: _layouts.post
section: content
title: Luminis Devcon 2015
date: 2015-05-01
author: Ronald van Eede
description: Luminis Devcon 2015
cover_image: https://picsum.photos/seed/luminisdevcon/848/300
excerpt: On April 23 I visited the Luminis Devcon 2015 conference, a small developers conference with about 350 visitors in the Cinemec in Ede. This was another opportunity to get some inspiration, learn some new things and to keep up to speed with what is happening in our field of work.
published: true
featured: false
categories: [Conference]
---

This is the original article, you can also find this article on my employer’s website.

On April 23 I visited the Luminis Devcon 2015 conference, a small developers conference with about 350 visitors in the Cinemec in Ede.
This was another opportunity to get some inspiration, learn some new things and to keep up to speed with what is happening in our field of work.
Just like many other recent conferences there where a few recurring subjects. Those subjects where the Cloud, Docker, Microservices and IoT (Internet of Things).  
But of course there where also talks about other subjects like real-time data analysis, Continues Deployment, development processes and functional programming.

The conference started with a small opening talk and the opening keynote. The opening keynote was presented by James Governor, co-founder of RedMonk.
He talked about some of the trends that give developers the freedom to build what they want by levering the power of agile development, open source and cloud computing. The technology stacks used are less and less dictated by established powers but more and more by the developers themselves. They can create their own stacks and methodologies without asking permission.  
He also talked about the disruptions that almost every industry faces today by well-funded startups. Think about Uber disrupting the cab industry and Airbnb doing the same to the Hotel industry. But also for example Github. With Github you could now follow the work of the most successful developers. Something that was nearly impossible a few years ago.

After the keynote there was time for a short break and then the conference continued with 4 tracks with 3 one-hour time slots with other talks.
I visited the talks about Docker, Microservices and Continues Deployment.

The first talk I visited was called ‘To Docker and beyond — production grade cloud deployments’. This talk was presented by Paul Bakker en Arjan Schaaf and they talked about the migration of several Amazon EC2 cloud platform based applications to a Dockerized infrastructure on a public cloud. They assumed you already know the basics of docker and talked about some of the things you need to take into account when you start using containers in a production infrastructure.  
Things like how do you start containers in a cluster? How do you link the containers together? And how do you register them to a loadbalancer. There are many tools available to help you with those kind of things. They explained the differences between tools like CoreOs, systemd, fleet, etcd, Consul and Kubernetes and when you can use which tool.

After the Docker talk it was time to go to the next talk. I visited the talk about Microservices. During this talk Marcel Offermans talked about building applications using Microservices. Building large applications in a world that is rapidly evolving can be a challenge. You have to keep up with functional and non-functional requirements that change but also with new and better techniques and technologies. Building your application with Microservices can help you a lot with that, but only if you do it correct. Some of things you need to think about are maintainability. You have to be able to dispose or replace a single service without too much trouble.  
Each microservice needs to own it’s own data, data should not be shared between microservices. These are only some examples. There is a lot more to think about. Another thing that is very important when doing microservices is automated deployment, you do not want to have to manually deploy dozens of microservices. and design for change and design for failure. Your microservices can fail and they will fail. If you design your infrastructure properly it will recover from failure without the users even noticing.  
At the end of the talk Marcel gave a live demo of building microservices using OSGi. He created a small client-server application that allowed him to run multiple instances of a rest server with different means of loadbalancing between the servers. When one of the servers failed the other servers would take over the load and when the failed server came back it automatically continued processing requests.

Now it was time for dinner. The dinner was well organized with small booths placed all around the venue where you could get all kind of different dishes and drinks. Of course the french fries where the most popular.

Then it was time for the last talks. I went to the Continues Deployment talk ‘To production: from 7 months to 7 minutes in 7 sprints’. In this talk Herbert Schuurmans and Michaël van Leeuwen talked about how you could setup a fully working Continues Deployment pipeline in 7 sprints, extending the pipeline every sprint. In a time it is important to deliver new features as quickly as possible a Continues Deployment pipeline becomes more and more important.  
To deploy your code in a production environment in a reliable way you need to automate the whole process and make it as fast as possible. Doing agile development means you want to get feedback from your customers as quickly as possible. So instead of building a complete product for months and then go live you have to go live with a so called minimal viable product, collect feedback and act on that feedback quickly and deploy a new version as fast as possible.  
Some companies like for example Etsy deliver new features to production multiple times a day. They can do that because they fully automated their build street. Because they can deliver to production multiple times a day they can act on customer feedback very quickly.

After the talks there was some time to get a drink and meet with other people. I also met a few former colleagues at the conference.
The conference was closed with the possibility to watch the movie ‘The Imitation Game’.  
This movie shows the story of Alan Turing and his work to crack the Enigma machine that was used in the second world war by the Germans to encrypt military messages. We do not know how the world would look like without him, but thanks to his work we can practice our profession as we know it today.

In general the conference was nice. I expected the level of talks to be a bit higher then they turned out to be but even though I still learned some new things and get some refreshing inspiration.