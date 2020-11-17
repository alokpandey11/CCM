//Set of questions and answers -DONE
//Give each answer an identifier -DONE
//Each identifier will increment through each question
//St the end the identifier with the highest number is the winner 
//Display the answer and rest the quiz

//pass results from previous question to the next page using localcache

//Randomise the background of the quiz for each questiion



let currentQuestion = 0;
let score = [];
let selectedAnswersData = [];
const totalQuestions =questions.length;

const container = document.querySelector('.quiz-card');
const questionEl = document.querySelector('.question');
const option1 = document.querySelector('.option1');
const option2 = document.querySelector('.option2');
const option3 = document.querySelector('.option3');
const option4 = document.querySelector('.option4');
const option5 = document.querySelector('.option5');
const nextButton = document.querySelector('.next');
const previousButton = document.querySelector('.previous');
const restartButton = document.querySelector('.restart');
const result = document.querySelector('.result');

//Function to generate question 
function generateQuestions (index) {
    //Select each question by passing it a particular index
    const question = questions[index];
    const option1Total = questions[index].answer1Total;
    const option2Total = questions[index].answer2Total;
    const option3Total = questions[index].answer3Total;
    const option4Total = questions[index].answer4Total;
    const option5Total = questions[index].answer5Total;
    //Populate html elements 
    questionEl.innerHTML = `<b style="color: #44D7A8;">${index + 1}.</b> ${question.question}`
    option1.setAttribute('data-total', `${option1Total}`);
    option2.setAttribute('data-total', `${option2Total}`);
    option3.setAttribute('data-total', `${option3Total}`);
    option4.setAttribute('data-total', `${option4Total}`);
    option5.setAttribute('data-total', `${option5Total}`);
    option1.innerHTML = `${question.answer1}`
    option2.innerHTML = `${question.answer2}`
    option3.innerHTML = `${question.answer3}`
    option4.innerHTML = `${question.answer4}`
    option5.innerHTML = `${question.answer5}`
}


function loadNextQuestion () {
    const selectedOption = document.querySelector('input[type="radio"]:checked');
    //Check if there is a radio input checked
    if(!selectedOption) {
        alert('Please select your answer!');
        return;
    }
    //Get value of selected radio
    const answerScore = Number(selectedOption.nextElementSibling.getAttribute('data-total'));

    ////Add the answer score to the score array
    score.push(answerScore);

    selectedAnswersData.push()
    

    const totalScore = score.reduce((total, currentNum) => total + currentNum);

    //Finally we increment the current question number ( to be used as the index for each array)
    currentQuestion++;

        //once finished clear checked
        selectedOption.checked = false;
    //If quiz is on the final question
    if(currentQuestion == totalQuestions - 1) {
        nextButton.textContent = 'Finish';
    }
    //If the quiz is finished then we hide the questions container and show the results 
    if(currentQuestion == totalQuestions) {
        container.style.display = 'none';
        var fort= (score[0]+score[1]+score[2])/3;
        var ir=(score[3]+score[4]+score[5]+score[6]+score[7])/5;
        var eq=(score[8]+score[9]+score[10]+score[11])/4;
        if((fort==ir)&&(ir==eq))
        {
          var improve= "You need to improve fortitude, introspective reflection and equanimity.<br>";
          var str= "<b>Fortitude</b> <a style='font-weight: 400;'>is the strength of mind that enables a person to encounter danger or bear pain or adversity with courage.<a/><br><b>Introspective reflection</b> <a style='font-weight: 400;'>is the capacity of humans to exercise introspection and to attempt to learn more about their fundamental nature and essence.</a><br><b>Equanimity</b> <a style='font-weight: 400;'>is a state of psychological stability and composure which is undisturbed by experience of or exposure to emotions, pain, or other phenomena that may cause others to lose the balance of their mind.</a>";
        }
        else if((Math.min(fort, ir, eq)==fort)&&(Math.min(fort, ir, eq)==ir))
        {
          var improve= "You need to improve fortitude and introspective reflection.";
          var str= "<b>Fortitude</b> <a style='font-weight: 400;'>is the strength of mind that enables a person to encounter danger or bear pain or adversity with courage.</a><br><b>Introspective reflection</b> <a style='font-weight: 400;'>is the capacity of humans to exercise introspection and to attempt to learn more about their fundamental nature and essence.</a>";
        }
        else if((Math.min(fort, ir, eq)==fort)&&(Math.min(fort, ir, eq)==eq))
        {
          var improve= "You need to improve fortitude and equanimity."; 
          var str= "<b>Fortitude</b> <a style='font-weight: 400;'>is the strength of mind that enables a person to encounter danger or bear pain or adversity with courage.</a><br><b>Equanimity</b> <a style='font-weight: 400;'>is a state of psychological stability and composure which is undisturbed by experience of or exposure to emotions, pain, or other phenomena that may cause others to lose the balance of their mind.</a>";
        }
        else if((Math.min(fort, ir, eq)==ir)&&(Math.min(fort, ir, eq)==eq))
        {
          var improve= "You need to improve introspective reflection and equanimity."; 
          var str= "<b>Introspective reflection</b> <a style='font-weight: 400;'>is the capacity of humans to exercise introspection and to attempt to learn more about their fundamental nature and essence.</a><br><b>Equanimity</b> <a style='font-weight: 400;'>is a state of psychological stability and composure which is undisturbed by experience of or exposure to emotions, pain, or other phenomena that may cause others to lose the balance of their mind.</a>";
        }
        else if(Math.min(fort, ir, eq)==fort)
        {
          var improve= "You need to improve fortitude.";
          var str= "<b>Fortitude</b> <a style='font-weight: 400;'>is the strength of mind that enables a person to encounter danger or bear pain or adversity with courage.</a>";
        }
        else if(Math.min(fort, ir, eq)==ir)
        {
            var improve= "You need to improve introspective reflection.";
            var str= "<b>Introspective reflection</b> <a style='font-weight: 400;'>is the capacity of humans to exercise introspection and to attempt to learn more about their fundamental nature and essence.</a>";
        }
        else{
            var improve= "You need to improve equanimity.";
            var str= "<b>Equanimity</b> <a style='font-weight: 400;'>is a state of psychological stability and composure which is undisturbed by experience of or exposure to emotions, pain, or other phenomena that may cause others to lose the balance of their mind.</a>";
        }
        document.write(`<html><head>
         <meta charset="UTF-8" />
  <meta name="description"
    content="The Centre for Conflict Management is a not-for-profit, voluntary initiative for creating a peaceful, inclusive and vibrant world under the able guidance and mentorship of world-renowned expert in negotiation and conflict management Prof. Himanshu Rai, Director, IIM Indore." />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>C4CM|Quiz</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />

  <link href="home.css" rel="stylesheet" />
  <link href="quiz.css" rel="stylesheet" />

<style>
    body{
      background-image: url("images/spirituality.jpeg");

    }
  </style>
</head>

<body>
  <!-- navbar-->
  <div class="container-fluid">
    <nav class="navbar stripe navbar-expand-lg navbar-light fixed-top">
      <a class="text-white navbar-brand" href="index.html">CCM</a>
      <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" style="border: 0;">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="text-white nav-item nav-link active" href="index.html">Home <span
              class="sr-only">(current)</span></a>
          <a class="nav-item nav-link text-white" href="index.html#aboutuselement">About</a>
          <a class="nav-item nav-link text-white" href="gallery.html">Gallery</a>
          <a class="nav-item nav-link text-white" href="index.html#ourteamelement">Our Team</a>
          <a class="nav-item nav-link text-white" href="index.html#contactelement">Contact</a>
          <a class="nav-item nav-link text-white" href="FAQ.html#">FAQ</a>
        </div>
      </div>
    </nav>
    <br><br><br>

 <div class="quiz-card">
      <div style="font-size: 1rem; color: #F5F5F5;">abc<br></div>
        <div class="title"><h4>How spiritual are you?</h4></div><hr>
        <h2 class="final-score">Result: ${(totalScore/60*100).toFixed(2)} %</h2><br>
        <h4 style="margin-left: 1.0vw;"><b>Recommendation:</b>&nbsp${(improve)}</h4><br>
        <h5 style="margin-left: 1.5vw;">${(str)}</h5><br>
        <button class="restart" onclick="location.href = 'quiz.html';"><h5>Take another test</h5></button>
        <br><h4 style="margin-left: 1.0vw;">To know more</h4> <button class="restart" onclick="location.href = 'share.html';"><h5>Share your conflict</h5></button>
    </div>
    </div>
    </div><br><br><br><br><br>

         
         
        <footer class="blog-footer text-center" id="footer" style="margin-bottom: 0;">
    <p class="footer-icons">
      <a href="http://linkedin.com/in/centre4cm" target="_blank"><i class="fa fa-linkedin"></i></a>
      <a href="https://twitter.com/centre4cm" target="_blank"><i class="fa fa-twitter"></i></a>
      <a href="https://www.facebook.com/centre4cm/" target="_blank"><i class="fa fa-facebook"></i></a>
      <a href="https://www.instagram.com/centre4cm/" target="_blank"><i class="fa fa-instagram"></i></a>
    </p>
    <p>&copy; 2020 Centre for Conflict Management.</p>
    <p>
      <a href="#">Back to top</a>
    </p>
    <p>
      Disclaimer: The responses given by our resource persons are based on
      their learnings and experience. They should, by no means, be taken as a
      substitute for medical/professional help.
    </p>
  </footer>


  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
          integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
          crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

    <script src=questions.js></script>
    <script src="quiz.js"></script>


  </body>
  </html>`);
         ;
        return;
    }
    generateQuestions(currentQuestion);
}

//Function to load previous question
function loadPreviousQuestion() {
    //Decrement quentions index
    currentQuestion--;
    //remove last array value;
    score.pop();
    //Generate the question
    generateQuestions(currentQuestion);
}




generateQuestions(currentQuestion);
nextButton.addEventListener('click', loadNextQuestion);
previousButton.addEventListener('click',loadPreviousQuestion);



