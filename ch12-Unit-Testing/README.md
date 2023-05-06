# Chapter 12. Unit Testing


*recap*

__Size__     -> Resources consumed by a test & what it is allowed to do?  
__Scope__ -> How much code a test is intended to validate.

**Unit tests advantages** 

1. Small [ fast & deterministic ].
2. Easy to write.
3. Promote high level of test coverage.
4. Easy to understand what’s wrong when (fail) [ simple & focused ].  
5. Can serve as documentation and examples.

> We Encourages engineers 80% unit tests and 20% broader-scoped tests.

## The Importance of Maintainability

Problems when tests lack `Maintainability`.  
**Tests were brittle** : they broke in response to a harmless & unrelated change
  that introduced no real bugs.  
**Tests were unclear**: after they were failing, it was difficult to determine what was wrong, how to fix it, and what those tests were supposed to be doing in the first place.

## Preventing Brittle Tests

means that the test fails in the face of an unrelated change to production code that does not introduce any real bugs.

 if a team regularly writes brittle tests, test maintenance consume a larger team’s time to comb through number of failures.
 
 `Practices & patterns to make tests more robust to change`
 
### *Strive for Unchanging Tests*
the ideal test is unchanging: after it’s written, it never needs to change unless the requirements of the system under test change.
> Refactoring should not affect the system behavior/functionality.

4 kinds of changes tests may respond to:
1. **Pure refactorings**:  
	Tests changed during a refactoring indicate  
		- ( change is affecting the system’s behavior !=pure)  
		- ( tests were not written at a level of abstraction). 
2. **New features**  :  
	new features or behaviors. we must write new tests to cover them.
	no change to any existing tests because it suggests unintended consequences
	 of that feature or inappropriate tests.
3. **Bug fixes** :   
	should include missing test case & don't require updates to existing tests.
4. **Behavior Changes**:  
	Only case we expect to update to the system’s existing tests.

> * When you write a test, you should not touch it again as you refactor
      the system, fix bugs, or add new features.
> * Changes in a system’s behavior should require going back to change its tests


### *Test via Public APIs*

  `Naive Test : `  
   It peers into the system’s internal state and calls methods that are not
   publicly exposed as part of the system’s API. As a result, the test is brittle
   so any refactoring to the system under test will cause the test to break.  
   `Tests using only public APIs : `   
   accessing the system under test are more realistic and less brittle
   you’re free to refactor without worrying about making changes to tests.
   
   > Defining an appropriate scope for a unit 
      & what should be considered the public API
    
* If a class only to support other classes (“helper class”), it is not its own unit, 
    should be tested through those classes instead of directly. 
    
* If a class is accessible without having to consult with its owners,
     it almost certainly constitutes a unit that should be tested directly.
	
* If a class can be accessed only by owners (“support library”).
	it should also be considered a unit and tested directly.	
	
	> testing via public APIs is better than testing against implementation details.
	
### *Test State, Not Interactions*

**state testing** you observe the system itself to see what it looks like
 			after invoking with it. 
**interaction testing** you check that the system took an expected 
			sequence of actions on its collaborators in response to invoking it. 
		
> Interaction tests tend to be more brittle than state tests
> We prefer the use of real objects in favor of mocked objects,
   as long as the real objects are fast and deterministic
## Writing Clear Tests
**Test failures** provide useful signals,which make a test provides value.
*reasons*:
* The system under test has a problem or is incomplete
* The test itself is flawed.

The speed at which the engineer can diagnose the failure cause depends on the test’s clarity.

Clear tests also bring other benefits, such as documenting the system under test and more easily serving as a basis for new tests.

unclear production code is not worse than unclear test.
With an unclear test, you might never understand its purpose, since removing the test will have no effect other than (potentially) introducing a subtle hole in test coverage & providing zero value.

### *Make Your Tests Complete and Concise*
2 props to achieve clarity  
 **Complete** : contains all of the information a reader needs 
 							in order to understand how it arrives at its result.
 							
**Concise** : contains no other distracting or irrelevant information.  
Incomplete / Cluttered test case:
```
@Test
public void shouldPerformAddition() {
  Calculator calculator = new Calculator(new RoundingStrategy(), 
      "unused", ENABLE_COSINE_FEATURE, 0.01, calculusEngine, false);
  int result = calculator.calculate(newTestCalculation());
  assertThat(result).isEqualTo(5); // Where did this number come from?
}
```

Complete / Concise test case:
```
@Test
public void shouldPerformAddition() {
  Calculator calculator = newCalculator();
  int result = calculator.calculate(newCalculation(2, Operation.PLUS, 3));
  assertThat(result).isEqualTo(5);
}
```

> A test’s body should contain all of the information needed to understand
   it without containing any irrelevant or distracting information.

### *Test Behaviors, Not Methods*

Engineers match the structure of their tests to the structure of their code 
( every production method has a corresponding test method). ` A method-driven test` which can be convenient at first, but over time (complexity grows) it leads to problems. as it encourages unclear tests because a single method does a few different things under the hood.

A **behavior** is any guarantee that a system makes about how it will respond to a series of inputs while in a particular state.

` “given,” “when,” and “then”:`

> Methods & Behaviors is many-to-many:  
	- methods implement -> multiple behaviors.   
	- behaviors rely on the interaction of multiple methods.
	
splitting apart the single test is more than worth it,
 & the resulting tests are much clearer

System Code:
```
public void displayTransactionResults(User user, Transaction transaction) {
  ui.showMessage("You bought a " + transaction.getItemName());
  if (user.getBalance() < LOW_BALANCE_THRESHOLD) {
    ui.showMessage("Warning: your balance is low!");
  }
}
```

Method-driven test:
```
@Test
public void testDisplayTransactionResults() {
  transactionProcessor.displayTransactionResults(
      newUserWithBalance(
          LOW_BALANCE_THRESHOLD.plus(dollars(2))),
      new Transaction("Some Item", dollars(3)));

  assertThat(ui.getText()).contains("You bought a Some Item");
  assertThat(ui.getText()).contains("your balance is low");
}
```

Behavior-driven test:
```
@Test
public void displayTransactionResults_showsItemName() {
  transactionProcessor.displayTransactionResults(
      new User(), new Transaction("Some Item"));
  assertThat(ui.getText()).contains("You bought a Some Item");
}

@Test
public void displayTransactionResults_showsLowBalanceWarning() {
  transactionProcessor.displayTransactionResults(
      newUserWithBalance(
          LOW_BALANCE_THRESHOLD.plus(dollars(2))),
      new Transaction("Some Item", dollars(3)));
  assertThat(ui.getText()).contains("your balance is low");
}
```

Behavior-driven tests tend to be clearer than method-oriented tests due to:
1. Are read more like natural language,
2. Clearly express cause and effect as test is more limited in scope
3. Each test is short and descriptive.

Every behavior has three parts: 
A “given” :  How the system is set up,
A “when” :  Action to be taken on the system, 
A “then”  :  Validates the result.

Read behavior-driven test at 3 levels : 
* Look at test method name (rough description).
* Look at the given/when/then comments for a formal description of the behavior.
* Look at the actual code to see precisely how that behavior is expressed.

`This pattern is violated by interspersing assertions among calls to the system under test (i.e., combining the “when” and “then” blocks). Merging the “then” and “when”`.

> A test should cover only a single behavior, one “when” and one “then” block.

The test `name` is very important : 
1) Only token visible in failure reports.
2) Communicate the problem when the test breaks.
3) Express the intent of the test.  
It should summarize the behavior/describe actions taken on a system & the expected outcome.

`Extra Verbosity in test names is warranted.`

### *Don’t Put Logic in Tests*
Test needs to handle only a particular set of inputs, while
production code must be generalized to handle any input.
>  If you feel like you need to write a test to verify your test, something has gone wrong!

> In test code, stick to straight-line code over clever logic, and consider tolerating some duplication when it makes the test more descriptive and meaningful. 

### *Write Clear Failure Messages*
- One last aspect of clarity is what an engineer sees when it fails.
- A good failure message contains same information as the test’s name: 
it should clearly express the desired outcome, the actual outcome, 
and any relevant parameters.

## Tests and Code Sharing: DAMP, Not DRY
Most software attempts to achieve DRY as it is especially valuable in making changes easier because an engineer needs to update only one piece of code.

The downside to such consolidation is that it can make code unclear, requiring readers to follow chains of references to understand what the code is doing.

DAMP : “Descriptive And Meaningful Phrases."
DAMP is not a replacement for DRY; it is complementary to it.

Helper methods and test infrastructure can still help make tests clearer by making them more concise, factoring out repetitive steps whose details aren’t relevant to the particular behavior being tested. 

### *Shared Values*
* Many tests are structured by a set of shared values to be used by tests and then by defining the tests that cover various cases for how these values interact.

* Engineers use shared constants because constructing individual values in each test can be verbose. 

* A better way to accomplish this goal is to construct data using helper methods.

* The test author specify only values he cares about, and setting reasonable defaults for all other values. 

* Using helper methods to construct values allows each test to create the exact values it needs without having to worry about irrelevant information or conflicting with other tests.


### *Shared Setup*
Engineers define methods to execute before each test in a suite is run. these methods can make tests clearer and more concise by obviating the repetition of tedious and irrelevant initialization logic. but it [can harm a test’s completeness by hiding important details in a separate initialization method.]

setup Methods construct the object under tests and its collaborators. This is useful when the majority of tests don’t care about the specific arguments used to construct those objects and can let them stay in their default state.

They can lead to unclear tests if (begin to depend on the particular values used in setup.)

Ex :
```
private NameService nameService;
private UserStore userStore;

@Before
public void setUp() {
  nameService = new NameService();
  nameService.set("user1", "Donald Knuth");
  userStore = new UserStore(nameService);
}

// [... hundreds of lines of tests ...]

@Test
public void shouldReturnNameFromService() {
  UserDetails user = userStore.get("user1");
  assertThat(user.getName()).isEqualTo("Donald Knuth");
}
```

Tests like these care about particular values & should state those values directly, overriding the default defined in the setup method if need be.
The resulting test contains slightly more repetition, but more descriptive and meaningful.  
[Not all users' name is 'Donald Knuth' => such a particular value should not be in setup]

### *Shared Helpers and Validation*

* `validate `method called at the end of every test method

* With such tests, it is much more difficult to determine the intent of any particular test and to infer what exact case the author had in mind when writing it

* The best validation helper methods assert a single conceptual fact about their inputs, in contrast to general-purpose validation methods that cover a range of conditions. 

* Such methods can be helpful when the condition is simple but requires looping or conditional logic to implement that'll reduce clarity were it included in the body of a test method.

### *Defining Test Infrastructure* 

means => (share code across multiple test suites)

It's similar to production code than it is to other test code given that it can have many callers that depend on it and can be difficult to change without introducing breakages.

Test infrastructure needs to be treated as its own separate product.
Test infrastructure must always have its own tests
