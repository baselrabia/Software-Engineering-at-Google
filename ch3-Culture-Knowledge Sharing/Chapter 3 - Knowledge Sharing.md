* **The presentation for this chapter is found [here](https://prezi.com/view/yDZXS4BH9TyPOe231487/)**

# Chapter 3 - Knowledge Sharing

* Your organization understands its problems better than anyone else. So, the organization should be answer most of its own questions. To acheive this, you need experts who know the answer of these questions and mechanisms to distribute the knowledge like (ask questions, document questions and answers, tutorials and classes).
* Your organization needs a *culture of learning* and psychological safety.

## Challenges to Learning
* Without a strong culture of learning, sharing expertise will be a harder task specially as the company scale and alot of challenges will appear like:
	1. *Lack of psycholocial safety* -> people afraid of punishment for taking risks and making mistakes.
	2. *Information islands* -> having knowledge fragmentation that occurs in different parts of an organization that don’t communicate with one another. And this leads to:
		1.  Information fragmentation -> each island have incomplete picture.
		2. Information duplication -> each island reinvent the wheel of doing something.
		3. Information skew -> each island do things by its own ways, which might conflict.
	3. *Single point of failure (SPOF)* -> happens when the critical information is available from only a single person (related to **Bus Factor**). SPOF can arise out of good intentions like "Let me take care of that for you", on the short term it is efficient because it is faster to do it but on the long term it is poor for scalability becuase team never learns.
	4. *All-or-nothing expertise* -> happens when experts do everthing themselves and don't take time to develop new experts through mentoring or docs.
	5. *parroting* -> This is typically characterized by mindlessly copying patterns or code without understanding their purpose.
	6. Haunted graveyards -> Places, often in code, that people avoid touching or changing because they are afraid that something might go wrong.

## Philosophy
-> **related to knowledge sharing**
* People are at the core of the software engineering. Every expert was once a novice and the organization's success depends on growing and investing in its people.
* One-to-one advice from expert is always invaluable and doesn't scale well because differnet team members have different areas of expertise.
* Documented knowledge, on the other hand, can better scale not just to the team but to the entire organization. Documented Knowledge like team wiki, documentation.
* The scalibility of documented knowledge comes with trade offs like it might be more generalized and less applicale to individual learners, and it comes with added maintenance cost required to keep information up-to-date over time.
* Written knowledge has scaling advantages, but so does targeted human help. A human expert can synthesize their expanse of knowledge. They can assess what information is applicable to the individual’s use case, determine whether the documentation is still relevant, and know where to find it. So **One-to-one advice and documented knowledge complement each other**.

## Setting the Stage: Psychological Safety
* Psychological safety is critical to promoting a learning environment and the most important part of an effective team.
* You must first acknowledge that there are things you don’t understand. We should welcome such honesty rather than punish it.
* In a healthy environment, people feel comfortable asking questions, being wrong, and learning new things.

### Mentorship
* Mentorship formalizes and facilitates learning.
* With a healthy team, teammates will be open not just to answering but also to asking questions: showing that they don’t know something and learning from one another.
* In Google, Noogler are ofthen assigned a mentor who is not their team member, manager or tech lead whose responsibilities explicity include answering questions and helping the Noogler ramp up. it makes it easier for the newcomer and make newcomer don't need to worry about taking up too much of their coworker' time.

### Psychological Safety in Large Groups
* Group solutions are more scalable than asking a nearby teammate, but they are also scarier. It can be intimidating for novices to form a question and ask it of a large group.
* The need for psychological safety is amplified in large groups. Every member of the group has a role to play in creating and maintaining a safe environment that ensures that newcomers are confident asking questions.
* "What?! I can’t believe you don’t know what the stack is!" and "It’s so easy my grandmother could do it!" --> makes the environment unsafe for anyone to ask a question.

## Growing Your Knowledge
* Knowledge sharing starts with yourself. It is important to recognize that you always have something to learn.

### Ask Questions
- **always be learning; always be asking questions.**
* One of the biggest mistakes that beginners make is not to ask for help when they’re stuck because they will be afraid that there questions are "too simple" or "you just need to try harder before asking help". Don’t fall into this trap! Your coworkers are often the best source of information: leverage this valuable resource.
* Engineers who have been at Google for years still have areas in which they don’t feel like they know what they are doing, and that’s OK! Don’t be afraid to say “I don’t know what that is; could you explain it?” Embrace not knowing things as an area of opportunity rather than one to fear.
* you should always be in an environment in which there’s something to learn.
* "The more you know, the more you know you don’t know"
* **On the receiving end**, patience and kindness when answering questions fosters an environment in which people feel safe looking for help. Making it easier to overcome the initial hesitation to ask a question and making it easier even for "trivial" question.

### Understand Context
* Learning is not just about understanding new things; it also includes developing an understanding of the decisions behind the design and implementation of existing things.
* legacy codebase example
* "Chesterson fence" principle -> before removing or changing somthing, first understand why it's there.
	“If you don’t see the use of it, I certainly won’t let you clear it away. Go away and think. Then, when you can come back and tell me that you do see the use of it, I may allow you to destroy it.”
* So, Many Google style guides explicitly include context to help readers understand the rationale behind the style guidelines instead of just memorizing a list of arbitrary rules and to make a better decisions.

## Scaling Your Questions: Ask the Community
* Getting One-to-one help is not scalable and as a learner, it can be difficult to remember every detail.
* Note:: *when you learn something from a one-to-one discussion, write it down and share what you write it.*
* It’s also beneficial to seek help not from individuals but from the greater community. In this section, we examine different forms of community-based learning. Each of these approaches—group chats, mailing lists, and question-and-answer systems—have different trade-offs and complement one another.

### Group Chats
* When you have a question, it can sometimes be difficult to get help from the right person. Maybe you’re not sure who knows the answer, or the person you want to ask is busy. In these situations, group chats are great, because you can ask your question to many people at once and have a quick back-and-forth conversation.
* As a bonus, other members of the group chat can learn from the question and answer.
* There are two kinds of group chats:
	* **Topic driven group chats** -> open to anyone, attract experts, questions usually answered.
	* **Team oriented group chats** -> smaller, restrict membership, feel safer to newcomer.
* Although group chats are great for quick questions, they don’t provide much structure, which can make it difficult to extract meaningful information from a conversation in which you’re not actively involved. And if you need to make it available to refer back to it later, you should write a document.

### Mailing Lists
* Asking a question on a public mailing list is a lot like asking a group chat: the question reaches a lot of people who could potentially answer it and anyone following the list can learn from the answer. Unlike group chats, though, public mailing lists are easy to share with a wider audience: they are packaged into searchable archives.
* Mailing lists are not without their trade-offs. They’re well suited for complicated questions that require a lot of context, but they’re clumsy for the quick back and forth exchanges at which group chats excel.

### YAQS: Question-and-Answer Platform
* YAQS ("Yet Another Question System") is a google internal version of Stack Over-flow, making it easy for Googlers to link to existing or work-in-progress code as well as discuss confidential information.
* YAQS shares many of the same advantages of mailing lists and adds refinements: answers marked as helpful are promoted in the user interface, and users can edit questions and answers so that they remain accurate and useful as code and facts change.

## Scaling Your Knowledge: You Always Have Something to Teach
* Teaching is not limited to experts.
* expertise is not a binary state in which you are either a novice or an expert. Expertise is a multidimensional vector of what you know: everyone has varying levels of expertise across different areas. This is one of the reasons why diversity is critical to organizational success.
* Google engineers teach others in a variety of ways, such as office hours, giving tech talks, teaching classes, writing documentation, and reviewing code.

### Office Hours
* Sometimes it’s really important to have a human to talk to, and in those instances, office hours can be a good solution.
* This is particularly useful if the problem is still ambiguous enough that the engineer doesn’t yet know what questions to ask or whether the problem is about something so specialized that there just isn’t documentation on it.

### Tech Talks and Classes
* Tech talks typically consist of a speaker presenting directly to an audience. Classes, on the other hand, can have a lecture component but often center on in-class exercises and therefore require more active participation from attendees.
* As a result, instructor-led classes are typically more demanding and expensive to create and maintain than tech talks and are reserved for the most important or difficult topics.
* Classes tend to work best when:
	* The topic is complicated and makes misunderstanding
	* The topic is relatively stable. (updating class material takes effort)
	* The topic benefits from having teachers to answer questions and provide one-to-one help.
* Example g2g (Googler2Googler) talks program.

### Documentation
* Documentation is written knowledge whose primary goal is to help its readers learn something.

#### Updating documentation
* The first time you learn something is the best time to see ways that the existing documentation and training materials can be improved.
* At this stage, if you find a mistake or omission in the documentation, fix it! Leave the campground cleaner than you found it. and try to update the documents yourself, even when that documentation is owned by a different part of the organization.
* example g3doc.

#### Creating documentation
* As your proficiency grows, write your own documentation and update existing docs. For example, if you set up a new development flow, document the steps. You can then  make it easier for others to follow in your path by pointing them to your document.
* Make sure there’s a mechanism for feedback. If there’s no easy and direct way for readers to indicate that documentation is outdated or inaccurate, they are likely not to bother telling anyone, and the next newcomer will come across the same problem. People are more willing to contribute changes if they feel that someone will actually notice and consider their suggestions.

##### Promoting documentation
* Writing documentation takes time and effort that could be spent on coding, and the benefits that result from that work are not immediate and are mostly depend on others.
* The documentation is good for the organization as a whole given that many people can benefit from the time invested by a few other people.
* Without recognition and motivation, It can be challenging to encourage engineers to write docs.
* Documentation authors can benefit from writing docs by saving time in future by pointing team members to the docs.

### Code
* code is knowledge, so the very act of writing code can be considered a form of knowledge transcription. Although knowledge sharing might not be a direct intent of production code, it is often an emergent side effect, which can be facilitated by code readability and clarity.
	* Code documentation is one way to share knowledge; clear documentation not only benefits consumers of the library, but also future maintainers.
* Implementation comments transmit knowledge across time: you’re writing these comments expressly for the sake of future readers.
* In terms of trade-offs, code comments are subject to the same downsides as general documentation: they need to be actively maintained or they can quickly become out of date.
* Code reviews are often a learning opportunity for both author and reviewer.

## Scaling Your Organization’s Knowledge
* Ensuring that expertise is appropriately shared across the organization becomes more difficult as the organization grows. Some things, like culture, are important at every stage of growth.

### Cultivating a Knowledge-Sharing Culture
* Focusing on the culture and environment first results in better outcomes than focusing on only the output—such as the code—of that environment.
* Google has taken some steps to create a culture that promotes learning:

#### 1. Respect
* The bad behavior of just a few individuals can make an entire team or community unwelcoming. In such an environment, novices learn to take their questions else‐where.
* Knowledge sharing can and should be done with kindness and respect. In tech, reverence of the "brilliant jerk" is harmful.
* Leaders improve the quality of the people around them, improve the team’s psychological safety, create a culture of teamwork and collaboration, defuse tensions within the team.

#### 2.Incentives and recognition
* encouraging a culture of knowledge sharing requires a commitment to recognizing and rewarding it at a systemic level.
* Google uses a variety of recognition mechanisms, from company-wide standards such as performance review and promotion criteria to peer-to-peer awards between Googlers.
* Peer bonuses program in Google are a monetary award and formal rec ognition that any Googler can bestow on any other Googler for above-and-beyond work. Because peer bonuses are employee driven, not management driven, they can have an important and powerful effect.
* A system in which people can formally and easily recognize their peers is a powerful tool for encouraging peers to keep doing the awesome things they do. It’s not the bonus that matters: it’s the peer acknowledgement.

### Establishing Canonical Sources of Information
* Canonical sources of information are centeralized, company-wide sources of information that provide a way to standardize and share expert knowledge.
* They work best for information that is relevent to all engineers within the organization.
* Establishing canonical sources of information requires higher investment than maintaining more localized information such as team documentation, but it also has broader benefits. Providing centeralized references for the entire organization.
* Because canonical information is highly visible and intended to provide a shared understanding at the organizational level, it's important that the content is actively maintained and vetted by subject matter experts. The more complex a topic, the more critical it is that canonical content has explicit owners.
* Creating and maintaining centerialized, canonical sources of information is expensive and time consuming, and not all content needs to be shared at an organizational level. When considering how much effort to invest in this resource, consider your audience, Who benefits from this information? You? Your team? Your product area? All engineers?.

* Examples of canonical sources in google:

#### Developer guides
* Google has a borad and deep set of official guidence for engineers, including style guides, official software engineering best practices, guides for code review and testing, and Tips of the Week.
* The sources of information is so large that it's impractical to expect engineers to read it all end to end, much less be able to absorb so much information at once. Instead, a human expert already familiar with a guideline can send a link to a fellow engineer, who then can read the reference and learn more. The expert svaes time by not needing to personally explain a company-wide practice, and the learner now knows that there is a information that they can access whenever necessary.
* Such process scales the knowledge and human well.

#### go/links
* go/links are Google's internal URL shortener. Google's internal URL shortener. Most Google-internal references have at least one internal go/link. For example, "go/spanner" provides information about Spanner, "go/python" is Google's Python developer guide. The content can live in any repo.
* Having a go/link that points to it provides a predictable, memorable way to access it.

#### Codelabs
* Google codelabs are guided, hands-on tutorials that teach engineers new concepts or processes by combining explanations, working best-practice example code, and code exercises. they are expensive to maintain and are not tailored to the learner's specific need.

#### Static analysis
* Static anaylsis tools are a powerful way to share best practices that can be checked programmatically. Every programming language has its own particular static analysis tools, but they have the same general purpose: to alert code authors and reviewers to ways in which code can be improved to follow style and best practices.
* They scale efficiently. When a check for a best practice is added to a tool, every engineer using that tool becomes aware of that best practice. This also frees up engineers to teach other.

### Staying in the Loop
* The formality of the information sharing medium depends on the importance of the information being delivered. Like information in documentation (more important and require more maintenance) and information in the newsletter (less important).'
* Examples in google:
	1. newsletter -> These are a good way to communicate information that is of interest to engineers but isn’t mission critical.
	2. communities -> Googlers like to form cross-organizational communities around various topics to share knowledge.

## Readability: Standardized Mentorship Through Code Review

* At Google, “readability” refers to more than just code readability; it is a standardized, Google wide mentorship process for apply programming language best practice.
* Readability covers a wide breadth of expertise, including but not limited to language idioms, code structure, API design, appropriate use of common libraries, documentation, and test coverage.
* "readability review" covers everything from ways the code could improved to whitespace conventions. This gave Google’s codebase a uniform appearance, it taught best practices for new hires.

### What is readability process?
* Code review is mandatory at Google. Every changelist (CL) requires readability approval, which indicates that someone who has readability certification for that language has approved the CL.
* To have a readability (readability certification). you need to get review over and over until they receive fewer and fewer comments on their CLs until they graduate from the process.
* Readability brings increased responsibility: engineers with readability are trusted to continue to apply their knowledge to their own code and to act as reviewers for other engineers’ code.
* Readability reviewers are held to the highest standards because they are expected not just to have deep language expertise, but also an aptitude for teaching through code review. **It should be a mentoring and cooperative process not adversial one**.
* Readability reviewers and CL authors alike are encouraged to have discussions during the review process.
* Readability is deliberately a human-driven process that aims to scale knowledge in a standardized yet personalized way.
* readability combines the advantages of written documentation, which can be accessed with citable references, with the advantages of expert human reviewers, who know which guidelines to cite.

#### Why Have This Process?
* Code is read far more than it is written, and this effect is magnified at Google’s scale. Any engineer can look at and learn from the wealth of knowledge that is the code of other teams. 
* Provide consistent standards for all code to follow.
* **Note Trade-off -->** Centeralizing the readability process around number of people who makes reviews makes the process harder to scale but on the other side it makes it easier to ensure consistency.
* Readability enables readers to focus on what the code does rather than being distracted by why it looks different than code that they’re used to.
* People can change teams and be confident that the way that the new team uses a given language is not drastically different than their previous team.
* The benefits of readability comes with costs:
	* Increased friction for teams that do not have any team members with readability,
	* Potential for additional rounds of code review for authors who need readability review.
	* Scaling disadvantages of being a human-driven process, because it depends on human reviewers.
* The program makes a deliberate trade-off of increased short-term code-review latency and upfront costs for the long-term payoffs of higher-quality code, repository-wide code consistency, increased engineer expertise and code that can live longer.
* Investing in static analysis tools improve readability and mitigate some of the costs of readability.
* The studies of Engineering Productivity Research (EPR) team in Google showed that readability has a net positive impact on engineering velocity. CLs by authors with readability take statistically significantly less time to review and submit than CLs by authors who do not have readability.