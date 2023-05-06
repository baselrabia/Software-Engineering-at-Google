# Chapter 12 - Unit Testing

* The previous chapter introduced two of the main axes along which Google classifies tests: size and scope. size refers to the resources consumed by a test and what it is allowed to do, and scope refers to how much code a test is intended to validate.
* We use the term unit test to refer to tests of relatively narrow scope, such as of a single class or method. Unit tests are usually small in size, but this isn’t always the case.
* After preventing bugs, the most important purpose of a test is to improve engineers’ productivity by:
	1. They tend to be small according to Google’s definitions of test size. Small tests are fast and deterministic, allowing developers to run them frequently as part of their workflow and get immediate feedback.
	2. They tend to be easy to write at the same time as the code they’re testing, allowing engineers to focus their tests on the code they’re working on without having to set up and understand a larger system.
	3. They promote high levels of test coverage.
	4. They tend to make it easy to understand what’s wrong when they fail.
	5. They can serve as documentation and examples, showing engineers how to us the part of the system being tested.

Because they make up such a big part of engineers’ lives, Google puts a lot of focus on
test maintainability. Maintainable tests are ones that “just work”: after writing them,
engineers don’t need to think about them again until they fail, and those failures indi‐
cate real bugs with clear causes.

## The Importance of Maintainability
* bad tests must be fixed before they are checked in.
- **brittle tests** are tests that broke in response to a harmless and unrelated change that introduce no real bugs.

## Perventing Birttle Tests
* A brittle test is one that fails in the face of an unrelated change to production code that does not introduce any real bugs.
* In small codebases with only a few engineers, having to tweak a few tests for every change might not be a big problem. But if a team regularly writes brittle tests, test maintenance will inevitably consume a larger and larger proportion of the team’s time.
* Brittle tests cause pain in codebases of any size. So, Google has identified a few practices and patterns that tends to make tests more robust to change.

### Strive for Unchanging Tests
* Before talking about patterns for avoiding brittle tests, we need to answer a question: just how often should we expect to need to change a test after writing it?. Any time spent updating old tests is time that can’t be spent on more valuable work. Therefore, *the ideal test is unchanging*
* We need to think about the kinds of changes that engineers make to production code and how we should expect tests to respond to those changes. Fundamentally, there are four kinds of changes:
	1. **Pure refactorings**
	2. **New features**
	3. **Bug fixes**
	4. **Behavior changes**

* The takeaway is that after you write a test, you shouldn’t need to touch that test again as you refactor the system, fix bugs, or add new features. This understanding is what makes it possible to work with a system at scale: expanding it requires writing only a small number of new tests related to the change you’re making rather than potentially having to touch every test that has ever been written against the system.
* Only breaking changes in a system’s behavior should require going back to change its tests, and in such situations, the cost of updating those tests tends to be small relative to the cost of updating all of the system’s users.

### Test via Public APIs
* We should make sure that tests don’t need to change unless the requirements of the system being tested change.By far the most important way to ensure this is to write tests that invoke the system being tested in the same way its users would; that is, make calls against its public API rather than its implementation details.
* If tests work the same way as the system’s users, by definition, change that breaks a test might also break a user.As an additional bonus, such tests can serve as useful examples and documentation for users.
* Tests using only public APIs are, by definition, accessing the system under test in the same manner that its users would. Such tests are more realistic and less brittle because they form explicit contracts: if such a test breaks, it implies that an existing user of the system will also be broken.
* When we say “public API” in this context, we’re really talking about the API exposed by that unit to third parties outside of the team that owns the code.

* What should be considered the public API is more art than science, but here are some rules of thumb:
	1. If a method or class exists only to support one or two other classes (i.e., it is a “helper class”), it probably shouldn’t be considered its own unit, and its functionality should be tested through those classes instead of directly.
	2. If a package or class is designed to be accessible by anyone without having to consult with its owners, it almost certainly constitutes a unit that should be tested directly.
	3. If a package or class can be accessed only by the people who own it, but it is designed to provide a general piece of functionality useful in a range of contexts (i.e., it is a “support library”), it should also be considered a unit and tested directly.

* Testing against public APIs won’t completely prevent brittleness, but it’s the most important thing you can do to ensure that your tests fail only in the event of meaningful changes to your system.

### Test State, Not Interactions
* In general, there are two ways to verify that a system under test behaves as expected. With state testing, you observe the system itself to see what it looks like after invoking with it. With interaction testing, you instead check that the system took an expected sequence of actions on its collaborators in response to invoking it.
* Interaction tests tend to be more brittle than state tests for the same reason that it’s more brittle to test a private method than to test a public method: interaction tests check how a system arrived at its result, whereas usually you should care only what the result is.
* The most common reason for problematic interaction tests is an over reliance on mocking frameworks. These frameworks make it easy to create test doubles that record and verify every call made against them, and to use those doubles in place of real objects in tests. This strategy leads directly to brittle interaction tests, and so we tend to prefer the use of real objects in favor of mocked objects, as long as the real objects are fast and deterministic.

## Writing Clear Tests
* Test failures happen for one of two reasons:
	1. The system under test has a problem or is incomplete. This result is exactly what tests are designed for: alerting you to bugs so that you can fix them.
	2. The test itself is flawed. In this case, nothing is wrong with the system under test, but the test was specified incorrectly. If this was an existing test rather than one that you just wrote, this means that the test is brittle.

* When a test fails, an engineer’s first job is to identify which of these cases the failure falls into and then to diagnose the actual problem. The speed at which the engineer can do so depends on the test’s clarity.
* clear test is one whose purpose for existing and reason for failing is immediately clear to the engineer diagnosing a failure.
* Clear tests also bring other benefits, such as documenting the system under test and more easily serving as a basis for new tests.
* For a test suite to scale and be useful over time, it’s important that each individual test in that suite be as clear as possible. This section explores techniques and ways of thinking about tests to achieve clarity.

### Make Your Tests Complete and Concise
* Two high-level properties that help tests achieve clarity are completeness and conciseness. A test is complete when its body contains all of the information a reader needs in order to understand how it arrives at its result. A test is concise when it contains no other distracting or irrelevant information.
* it can often be worth violating the DRY (Don’t Repeat Yourself) principle if it leads to clearer tests.

### Test Behaviors, Not Methods
* The first instinct of many engineers is to try to match the structure of their tests to the structure of their code such that every production method has a corresponding test method.
* This pattern can be convenient at first, but over time it leads to problems: as the method being tested grows more complex, its test also grows in complexity and becomes more difficult to reason about.
* The problem in Example 12-9 is that framing tests around methods can naturally encourage unclear tests because a single method often does a few different things under the hood and might have several tricky edge and corner cases.
* There’s a better way: rather than writing a test for each method, write a test for each behavior. A behavior is any guarantee that a system makes about how it will respond to a series of inputs while in a particular state.
- **Behaviors can often be expressed using the words “given,” “when,” and “then”**
- The extra boilerplate required to split apart the single test is more than worth it, and the resulting tests are much clearer than the original test.

- Behavior-driven tests tend to be clearer than method-oriented tests for several reasons:
	1. They read more like natural language, allowing them to be naturally understood rather than requiring laborious mental parsing.
	2. They more clearly express cause and effect because each test is more limited in scope.
	3. the fact that each test is short and descriptive makes it easier to see what functionality is already tested and encourages engineers to add new streamlined test methods instead of piling onto existing methods.

#### Structure tests to emphasize behavoirs
* Thinking about tests as being coupled to behaviors instead of methods significantly affects how they should be structured. Remember that every behavior has three parts: a “given” component that defines how the system is set up, a “when” component that defines the action to be taken on the system, and a “then” component that validates the result. Tests are clearest when this structure is explicit.

* This pattern makes it possible to read tests at three levels of granularity:
	1. A reader can start by looking at the test method name to get a rough description of the behavior being tested.
	2. If that’s not enough, the reader can look at the given/when/then comments for a formal description of the behavior.
	3. Finally, a reader can look at the actual code to see precisely how that behavior is expressed.

* This pattern is most commonly violated by interspersing assertions among multiple calls to the system under test. Merging the “then” and “when” blocks in this way can make the test less clear because it makes it difficult to distinguish the action being performed from the expected result.
* When a test does want to validate each step in a multistep process, it’s acceptable to define alternating sequences of when/then blocks. Long blocks can also be made more descriptive by splitting them up with the word “and.”
* When writing such tests, be careful to ensure that you’re not inadvertently testing multiple behaviors at the same time. Each test should cover only a single behavior.

#### Name tests after the behavior being tested
* With more focused behavior-driven tests, we have a lot more flexibility and the chance to convey usefuln information in the test’s name.
* The test name is very important: it will often be the first or only token visible in failure reports, so it’s your best opportunity to communicate the problem when the test breaks. It’s also the most straightforward way to express the intent of the test.
* A test’s name should summarize the behavior it is testing. A good name describes both the actions that are being taken on a system and the expected outcome. Test names will sometimes include additional information like the state of the system or its environment before taking action on it.

* Some sample method naming patterns:
```
multiplyingTwoPositiveNumbersShouldReturnAPositiveNumber
multiply_postiveAndNegative_returnsNegative
divide_byZero_throwsException
```

* A good trick if you’re stuck is to try starting the test name with the word “should.” When taken with the name of the class being tested, this naming scheme allows the test name to be read as a sentence. For example, a test of a `BankAccount` class named `shouldNotAllowWithdrawalsWhenBalanceIsEmpty` can be read as “BankAccount should not allow withdrawals when balance is empty.”
* if you need to use the word “and” in a test name, there’s a good chance that you’re actually testing multiple behaviors and should be writing multiple tests.

### Don't Put Logic in Tests
* it is obvious that a test is doing the correct thing just from glancing at it. This is possible in test code because each test needs to handle only a particular set of inputs, whereas production code must be generalized to handle any input.
* if you feel like you need to write a test to verify your test, something has gone wrong.
* Complexity is most often introduced in the form of logic. Logic is defined via the imperative parts of programming languages such as operators, loops, and conditionals. When a piece of code contains logic, you need to do a bit of mental computation to determine its result instead of just reading it off of the screen.
* The lesson is clear: in test code, stick to straight-line code over clever logic, and consider tolerating some duplication when it makes the test more descriptive and meaningful.

### Write Clear Failure Messages
* One last aspect of clarity has to do not with how a test is written, but with what an engineer sees when it fails.
* A good failure message contains much the same information as the test’s name: it should clearly express the desired outcome, the actual outcome, and any relevant parameters.
* A better failure message clearly distinguishes the expected from the actual state and gives more context about the result:
```
Expected an account in state CLOSED, but got account:
<{name: "my-account", state: "OPEN"}
```
instead of
```
Test failed: account is closed
```


## Tests and Code Sharing: DAMP, Not DRY
* One final aspect of writing clear tests and avoiding brittleness has to do with code sharing. Most software attempts to achieve a principle called DRY.
* “Don’t Repeat Yourself.” DRY states that software is easier to maintain if every concept is canonically represented in one place and code duplication is kept to a minimum.
* This approach is especially valuable in making changes easier because an engineer needs to update only one piece of code rather than tracking down multiple references.
* Good tests are designed to be stable, and in fact you usually want them to break when the system being tested changes. So DRY doesn’t have quite as much benefit when it comes to test code.
* Instead of being completely DRY, test code should often strive to be DAMP that is, to promote “Descriptive And Meaningful Phrases.” A little bit of duplication is OK in tests so long as that duplication makes the test simpler and clearer.
* tests with DAMP have more duplication, and the test bodies are a bit longer, but the extra verbosity is worth it. Each individual test is far more meaningful and can be understood entirely without leaving the test body.
* The important point is that such refactoring should be done with an eye toward making tests more descriptive and meaningful, and not solely in the name of reducing repetition.

* The rest of this section will explore common patterns for sharing code across tests:

### Shared Values
* Many tests are structured by defining a set of shared values to be used by tests and then by defining the tests that cover various cases for how these values interact.
* This strategy can make tests very concise, but it causes problems as the test suite grows. For one, it can be difficult to understand why a particular value was chosen for a test.
* A better way to accomplish this goal is to construct data using helper methods that require the test author to specify only values they care about, and setting reasonable defaults.

### Shared Setup
* A related way that tests shared code is via setup/initialization logic. Many test frameworks allow engineers to define methods to execute before each test in a suite is run. Used appropriately, these methods can make tests clearer and more concise by obviating the repetition of tedious and irrelevant initialization logic.
* Used inappropriately, these methods can harm a test’s completeness by hiding important details in a separate initialization method.
* One risk in using setup methods is that they can lead to unclear tests if those tests begin to depend on the particular values used in setup.

### Shared Helpers and Validation
* One common type of helper is a method that performs a common set of assertions against a system under test. The extreme example is a `validate` method called at the end of every test method, which performs a set of fixed checks against the system under test.
* When bugs are introduced, this strategy can also make them more difficult to localize because they will frequently cause a large number of tests to start failing.
* Such methods can be particularly helpful when the condition that they are validating is conceptually simple but requires looping or conditional logic to implement that would reduce clarity were it included in the body of a test method.

### Defining Test Infrastructure
* Sometimes, it can also be valuable to share code across multiple test suites. We refer to this sort of code as test infrastructure. Though it is usually more valuable in integration or end-to-end tests, carefully designed test infrastructure can make unit tests much easier to write in some circumstances.
* In many ways, test infrastructure code is more similar to production code than it is to other test code given that it can have many callers that depend on it and can be difficult to change without introducing breakages.
- *test infrastructure must always have its own tests.*
- 