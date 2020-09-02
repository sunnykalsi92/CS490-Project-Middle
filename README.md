# CS490-Project-Middle
Your Project:

You are to create an online exam system.The only type of question  will be similar to the open ended programming questions on a CS 100 (Python) exam. In fact, all questions will be of the following form:

"Write a function named ___________ that takes the following arguments _____________ performs the following operations ______________ and returns the value."

For example, a typical question might be:

"Write a function named doubleIt that takes a single int argument and calculates twice the value of the input and returns that value."

To complete your project you will be expected to meet the following milestones. At each milestone every student must upload his/her contribution to the project and one group member will present the current version of the project to the class. You must use the architecture given in class.

Alpha:

For the Alpha milestone, you must create a login system. There are two roles, teacher and student. You should create credentials, user id, password, and role for each user and store that information in the database. (Never store plain text passwords in a database, use the PHP hash function and store the hash of the password.)

There should be one login page where a user can enter id and password. Your system will authenticate the user, confirm his/her role and send them to the appropriate landing page - one for teachers, one for students.

Beta:

You will start implementing the following five use cases:

1) An instructor can enter questions into a question bank. There is only one type of question but, a real question bank should be able to hold hundreds of questions.

Each question should have additional information. At a minimum you must include the topic, difficulty (easy, medium, hard), and some test cases so that the question can be automatically graded, for example, doubleIt(5)->10, doubleIt(8)->16. For this milestone each question should have a minimum of 2 test cases. More test cases will be required in the next milestone depending on the question.

2) An instructor can select questions from the question bank to create an exam. A typical exam will have 3-4 questions. Once the questions are selected, points will be assigned to each question. (Note that questions themselves do not have points, only a difficulty level. Points are assigned to specific questions on an exam.)

3) A student will take the exam and submit the answers.

4) The instructor will preview the auto-graded results. The auto-grading should consist of two approaches: 1) Some items may be evaluated using string searches, such as checking if the name of the funcion is correct (a common mistake made by Freshman), and 2) using PHP exec to run the function with test case input and confirm whether or not the output matches.

For the Beta, you need to check the name, if it is incorrect subtract 5 points and correct it (so that the test cases can run), and you must run the 2 test cases.

You should take a look at codingbat.com for an example of the type of analysis the auto-grader should apply. Note that codingbat.com is a practice site not an exam site so there are distinct differences from our project, however, it does represent  a good example of how to properly evaluate and present results. Try a sample problem on codingbat to see it for yourself.

After reviewing the auto-graded results, an instructor should be able to correct individual sub-item grades per question, and add one comment per question.

5) The student should be able to review the graded exam which include the auto-graded results and the instructors corrections and comments.

Release Candidate:

You will improve upon the Beta and add the following to the use cases:

1) You must use a split screen. The left half is for the form to enter a new question. The right half is a filtered list of relevant questions. The list must be filtered by "topic", "difficulty" and key word of the question text. 

You will also add a new element to each question: constraints. Not all questions will have a constraint but, you must implement 2 possible contraints: 1) must use a for loop, 2) must print rather than return the result.

2) You must use a split screen. The left half is for the current exam that is being created. The right half is a filter list of questions similar to the one from use case 1 above. The main difference is that an instructor should now be able to use the list to select questions.

3) Make sure you display the points for each question to students taking the exam.

4) The auto-grader should now include constraints and check if the colon appears at the end of the first line of the answer (handle it as you did with the name: if it is missing, subtract points then add it so that the test cases will run.)

5) You must use tables to present the results for each question.

Release Version:

You will clean up the user interface, fix any bugs, and make the entire project as professional as possible in terms of functionality and appearance.





