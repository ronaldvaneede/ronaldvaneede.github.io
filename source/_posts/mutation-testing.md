---
extends: _layouts.post
section: content
title: Mutation testing
date: 2016-02-19
author: Ronald van Eede
description: This is your first blog post.
cover_image: https://picsum.photos/seed/mutationtesting/848/300
published: true
featured: false
excerpt: When you write code you also write tests to prove that your code works, right? But how do you know your tests are correct? How to test your tests? This is where Mutation Testing comes in. How does that work?
categories: [Development,Java,Testing]
---

This is the original article, you can also find this article on my employer’s website.

When you write code you also write tests to prove that your code works, right? But how do you know your tests are correct? How to test your tests?
This is where Mutation Testing comes in. How does that work?

The concept of mutation testing is simple, when you run your tests faults are automatically seeded into your code. If your tests fail the mutation is killed, are your tests still green? Then the mutation lived. So you can measure the quality of your tests by the amount of mutation that are killed.
So you run your unit tests against automatically modified versions of your code. When the code changes different results will be produced and your tests should fail.
Why?

Why do you want to do this? We can measure quality with test coverage, right? This is only true up to a certain level. There is no guarantee that your tests can actually detect faults. Test coverage only measures which code is executed.
How?

So how do we do this with Java? There are some mutation testing systems for Java but the most widely used one is [PIT](http://pitest.org/).

All you have to do to get started is to add a build plugin in your `pom.xml` and add some configuration for the classes you want to target and the tests that you want to use:

```xml
<plugin>
    <groupId>org.pitest</groupId>
    <artifactId>pitest-maven</artifactId>
    <version>1.1.6</version>
    <configuration>
        <targetClasses>
            <param>com.vaneede.ronald.pittest.factory*</param>
        </targetClasses>
        <targetTests>
            <param>com.vaneede.ronald.pittest.factory*</param>
        </targetTests>
    </configuration>
</plugin>
```

Now you can use the `mvn org.pitest:pitest-maven:mutationCoverage` command to run the mutation tests, but make sure you have a green unit test suite first, because PIT needs that. there is also a plugin available for IntelliJ and Eclipse.

To give it a try you can create a small Java project
Create a `Movie.java` file with this content:

```java
package com.vaneede.ronald.pittest.entity;

public class Movie {
    private final String id;
    private final String title;
    private final String director;
    
    public Movie(String id, String title, String director) {
        this.id = id;
        this.title = title;
        this.director = director;
    }
    
    public String getId() {
        return id;
    }
    
    public String getTitle() {
        return title;
    }
    
    public String getDirector() {
        return director;
    }
}
```

And a `MovieFactory.java` file:

```java
package com.vaneede.ronald.pittest.factory;

import com.vaneede.ronald.pittest.entity.Movie;
import java.util.UUID;

public class MovieFactory {
    private static final int MIN_LENGTH = 3;
    
    public Movie create(final String title, final String director) {
        if (title == null) {
            throw new IllegalArgumentException("title must be set");
        }
        if (title.length() <= MIN_LENGTH) {
            throw new IllegalArgumentException("title must have a minimal length of " + MIN_LENGTH);
        }
        if (director == null) {
            throw new IllegalArgumentException("director must be set");
        }
        
        return new Movie(UUID.randomUUID().toString().toUpperCase(), title, director);
    }
}
```

And a test class, `MovieFactroyTest`:

```java
package com.vaneede.ronald.pitest.factory;

import com.vaneede.ronald.pittest.entity.Movie;
import com.vaneede.ronald.pittest.factory.MovieFactory;
import org.junit.Test;

import static org.hamcrest.MatcherAssert.assertThat;
import static org.hamcrest.Matchers.equalTo;
import static org.hamcrest.Matchers.isEmptyOrNullString;
import static org.hamcrest.Matchers.not;
import static org.hamcrest.Matchers.notNullValue;

public class MovieFactoryTest {
    private static final String TITLE = "Pulp Fiction";
    private static final String DIRECTOR = "Quentin Tarantino";
    
    private final MovieFactory movieFactory = new MovieFactory();
    
    @Test
    public void shouldCreateMovie() throws Exception {
        final Movie movie = movieFactory.create(TITLE, DIRECTOR);
        assertThat(movie, notNullValue());
        assertThat(movie.getTitle(), equalTo(TITLE));
        assertThat(movie.getDirector(), equalTo(DIRECTOR));
        assertThat(movie.getId(), not(isEmptyOrNullString()));
    }
    
    @Test(expected = IllegalArgumentException.class)
    public void shouldFailCreateMovieWithNoTitleGiven() throws Exception {
        movieFactory.create(null, DIRECTOR);
    }
    
    @Test(expected = IllegalArgumentException.class)
    public void shouldFailCreateMovieWithNoDirectorGiven() throws Exception {
        movieFactory.create(TITLE, null);
    }
    
    @Test(expected = IllegalArgumentException.class)
    public void shouldFailCreateMovieWithTooShortTitleGiven() throws Exception {
        movieFactory.create("pf", DIRECTOR);
    }
}
```

When you run the tests with coverage you will see that all the code in the `MovieFactory` class is covered by the tests.
So we tested everything, right? Not entirely. Let's run PIT.  
PIT will run the tests again but it will make small changes to the code. It does this in-memory so it's fast and it does not change your actual code.
It changes things like `==` to `!=`, `!=` to `==`, `<=` to `<`, return `true` instead of `false`, or `false` instead of `true` etcetera.

```
================================================================================
- Statistics
================================================================================
>> Generated 8 mutations Killed 7 (88%)
>> Ran 11 tests (1.38 tests per mutation)
```

So it looks like our tests killed 7 mutations, but 1 survived. Can you already find it?  
Let's continue with the report summary:

```
================================================================================
- Mutators
================================================================================
> org.pitest.mutationtest.engine.gregor.mutators.ConditionalsBoundaryMutator
>> Generated 1 Killed 0 (0%)
> KILLED 0 SURVIVED 1 TIMED_OUT 0 NON_VIABLE 0
> MEMORY_ERROR 0 NOT_STARTED 0 STARTED 0 RUN_ERROR 0
> NO_COVERAGE 0
--------------------------------------------------------------------------------
> org.pitest.mutationtest.engine.gregor.mutators.ReturnValsMutator
>> Generated 4 Killed 4 (100%)
> KILLED 4 SURVIVED 0 TIMED_OUT 0 NON_VIABLE 0
> MEMORY_ERROR 0 NOT_STARTED 0 STARTED 0 RUN_ERROR 0
> NO_COVERAGE 0
--------------------------------------------------------------------------------
> org.pitest.mutationtest.engine.gregor.mutators.NegateConditionalsMutator
>> Generated 3 Killed 3 (100%)
> KILLED 3 SURVIVED 0 TIMED_OUT 0 NON_VIABLE 0
> MEMORY_ERROR 0 NOT_STARTED 0 STARTED 0 RUN_ERROR 0
> NO_COVERAGE 0
--------------------------------------------------------------------------------
```

## Mutators

So PIT used three different kind of mutators: `ConditionalsBoundaryMutator`, `ReturnValsMutator` and `NegateConditionalsMutator`.  
The `ConditionalsBoundaryMutator` changes `<` to `<=`, `<=` to `<`, `>` to `>=` and `>=` to `>`.  
The `ReturnValsMutator` changes the return values of your methods, so if your method normally returns true it is mutated to return false instead. Or it the method normally returns an Object it will return null.  
The `NegateConditionalsMutator` changes conditional statements, so it will change `==` to `!=`, `!=` to `==`, `<=` to `>`, `>=` to `<`, `<` to `>=` and `>` to `<=`. Besides these three mutators there are a total of 13 possible mutators, 7 of them are enabled by default, the others have to be enabled explicitly.  
As you can see in the report above only 3 out of the 7 that are enabled by default where used, that is because the others where not applicable for the example code.So we have 1 mutation that survived, let's take a deeper look at that one. PIT generated a nice HTML report in the target directory so we can open that in the browser.

<img src="/assets/img/moviefactory.java.png" class="mb-6 rounded-md shadow-md">

Light green shows line coverage.  
Dark green shows mutation coverage.  
Light pink show lack of line coverage.  
Dark pink shows lack of mutation coverage.

In the report you can see that there is a problem on line 14. PIT tested that line with a `NegateConditionalsMutator` and a `ConditionalsBoundaryMutator` mutator.
As you can see in the list of Mutations the `ConditionalsBoundaryMutator` mutation caused a test to fail, so the mutant survived.  
In this case this is because we only test for a movie title shorter than 3 characters but not for a title of exactly 3 characters. So by including mutation into our project we discovered that we where missing a test.  
This is only one small example, there are a lot more mutators that can be used, like the `VoidMethodCalls` mutator that removed calls to void methods or the `MathMutator` that changes calculations in your code.