---
extends: _layouts.post
section: content
title: GOTO Amsterdam 2015
date: 2015-11-08
author: Ronald van Eede
description: This is your first blog post.
cover_image: https://picsum.photos/seed/gotoamsterdam2015/848/300
published: true
featured: false
categories: [Conference]
excerpt: On June 18 and June 19 I visited the GOTO Amsterdam 2015 conference at the ‘Beurs van Berlage’ in Amsterdam. Here is a short report.
---

This is the original article, you can also find this article on my employer’s website.

On June 18 and June 19 I visited the GOTO Amsterdam 2015 conference at the ‘Beurs van Berlage’ in Amsterdam. Here is a short report.

<img src="/assets/img/gotoams2015.png" class="mb-6 rounded-md shadow-md">

The opening keynote on Thursday was done by Jeff Sutherland. He talked about three different types of organizations (US defence contractor (no name), Autodesk (CAD software) and Spotify) and now they are adapting to agile and scrum.

After that is was time for the regular talks.

On Thursday you could choose from 5 different tracks:
Microservices, Scrum, AngularJS, ElasticSearch and Solutions.

The first one I went to was '*From Hackathon to Production: Elasticsearch @ Facebook*' in the Elasticsearch track. In this talk Peter Vulgaris talked about how they moved from using Elasticsearch for a small hackathon self-service tool to using it all over the company and the issues they ran into with scaling.

Next up was '*Deeper Data Dimensions with Kibana*' by Rashid Khan in the Elasticsearch track.
He was talking about Kibana 4 and how you could use it to aggregate and visualize a large set of data using the new features of Kibana 4.

After the lunch it was time for the Microservices track, Chris Richardson’s talk '*Developing Event-driven Microservices with Event Sourcing & CQRS*' showed how you can make sure that your data stays consistent between multiple databases without using two-phase commit by using an event-driven architecture.

After that it was time for a talk in the Solutions track, '*Mayfly — Dockerize your User Stories*' by Patrick van Dissel and Maarten Dirkse from Bol.com. They talked about the open-source tool they are working on called Mayfly. Mayfly is a tool that uses Docker to power a user story centered development platform. This tool allows you to easily develop a feature in an isolated environment. This tool takes care of the git branch, enforcing a definition of done and setting up a short-lived continuous integration pipeline to test the application running in a Docker container on Mesos.

The last talk for this day was '*Step up your Game & Bring your Projects to the Next Level*' by Olivier Combe in the AngularJS track.
In this talk he showed different tools you can use to improve and modernize your front-end development workflow.

The evening keynote was named '*Agile is Dead*' and was presented by Dave Thomas, one of the creators of the Agile Manifesto. He talked about how the industry slowly turned the 'The Manifesto for Agile Software Development' into ‘The Agile Manifesto’ in other words, a manifesto that is agile. Agile is a adjective. While it should be 'The Agility Manifesto*. “Agile is not what you do. Agility is how you do it”

After some time for drinks and some food there was another keynote, '*Feedback Control & the Coming Machine Revolution*' by Raffaello D’Andrea about drones and robots and the future for that.

That concluded the thursday.

The Friday started with a keynote by Prof. Dr. Gunter Dueck called '*Swarm-Stupidity*'. The stupid swarm, often called a team, is a group of intelligent people who are working very hard and suffering during lots of meetings for dumb outputs. It reveals some roots of stupidity: management utopia syndromes (like “Please achieve more than 100% billable hours”) lead to too much pressure that leads to process turbulences that leads to lots of meetings to resolve issues that leads to stress and overtime that leads to a lack of time to deliver quality work...

On the Friday there were 6 tracks but on different subjects: Docker, Drones, Disruption, Hadoop, Lightning Talks and Solutions.

My first talk was about '*Using Docker Safely*' by Adrian Mouat. In his talk he showed how you can make sure your images have not been tampered and how to mitigate the risk of container exploits.

The next talk I went to was '*The Evolution of Hadoop at Spotify — Through Failures and Pain*' by Josh Baer and Rafal Wojdyla. They talked about how they grew from a few Hadoop machines to to aggregate played songs events for financial reports to their current cluster of over 900 nodes that plays a large role in many features that you use in their application today.

Next up: ‘Kubernetes — Open Source Container Management System’ by Wojtek Tyczynski from Google. In this presentation he talked about how running applications in containers for over a decade affected the Kubernetes architecture. He explained how Kubernetes handles scheduling onto nodes in a compute cluster and manages workloads to ensure their state matches with what the user declared.

Then it was again time for a presentation in the Docker track: ‘Docker as the Building Block for Datacenter-Scale Applications’ by Benjamin Hindman, co-creator of Mesos. He explained how leading companies like Twitter build distributed systems using Docker.

The last regular presentation I visited was ‘Huge Memory & Collection Oriented Programming -> Less Code More Speed?’ by Dave Thomas. He talked about what will happen when we have computers with 10 terabytes of non-volatile memory in a few years.

The closing keynote was '*Progress Toward an Engineering Discipline of Software*' by Mary Shaw, Professor of Computer Science at the Carnegie Mellon University. She talked about the big question, is software engineering really engineering.  
Classical engineering disciplines have emerged from craft practice and commercialization with a combination of codified knowledge and science. Using this pattern as a point of reference she sketched the evolution of software engineering to assess the maturity of the field and identify our challenges to really become engineering.

## LT:DR;

GOTO Amsterdam 2015 was a really nice conference. They had about 730 visitors and the quality of the talks is good with some exceptions. It is well organized and I liked the 20 minute breaks between to talks so you did not had to hurry to go to the next talk. During lunch they had enough places where you could get food so no long waiting lines.  
The location is also good, only 5 minutes walk from the Amsterdam Central train station.

If you want to visit a conference in the future I would certainly recommend GOTO Amsterdam.