const questionNumber = document.querySelector(".question-number");
const questionText = document.querySelector(".question-text");
const optionContainer = document.querySelector(".option-container");
const answersIndicatorContainer = document.querySelector(".answers-indicator");
const homeBox = document.querySelector('.home-box');
const quizBox = document.querySelector('.quiz-box');
const resultBox = document.querySelector('.result-box');
const nextBtn = document.querySelector('.btnQuiz');
const notAnswerNoti = document.querySelector('.notAnswerNoti');

let questionCounter = 0;
let currentQuestion;
let avaliableQuestion = [];
let avaliableOption = [];
let correctAnswers = 0;
let attempt = 0;
let timerForNoti;

function setAvaliableQuestions(){
    const totalQuestion = quiz.length;  
    
    for (let index = 0; index < totalQuestion; index++) {
        avaliableQuestion.push(quiz[index]);
    }
    
}

function getNewQuestion() // set question, number and options
{
    //set for question no
    questionNumber.innerHTML = "Question " + (questionCounter + 1)  + " of " + quiz.length;
    //set question text
    //for random question
    const questionIndex = avaliableQuestion[Math.floor(Math.random() * avaliableQuestion.length)];
    currentQuestion = questionIndex;
    questionText.innerHTML = currentQuestion.q;
    //get position of questionIndex from the availableQuestmion array
    const index1 = avaliableQuestion.indexOf(questionIndex);
    //remove questionIndex from the avaliableQuestion array to avoid repeating of questionshykx
    avaliableQuestion.splice(index1,1);

    console.log(questionIndex);
    console.log(avaliableQuestion);

    questionCounter++;

    //show question img if 'img' property exists
    if(currentQuestion.hasOwnProperty('img'))
    {
        const img = document.createElement("img");
        img.src = currentQuestion.img;
        questionText.appendChild(img);
    }

    //set options
    //get the length of options
    const optionLength = currentQuestion.options.length;
    // push options into avaliableOption Array
    for (let index = 0; index < optionLength; index++) {
        avaliableOption.push(index);        
    }
    optionContainer.innerHTML = '';
    let animationDelay = 0.15;

    // creating options in html 
    for (let index = 0; index < optionLength; index++) {
        //randomnizing options
        const optionIndex = avaliableOption[Math.floor(Math.random() * avaliableOption.length)];
        //get position of optionIndex from avaliableOption
        const index2 = avaliableOption.indexOf(optionIndex);
        //remove optionIndex from avaliableOPtions 
        avaliableOption.splice(index2,1);
        console.log(optionIndex);
        const option = document.createElement("div");        
        option.innerHTML = currentQuestion.options[optionIndex];
        option.id = optionIndex;
        option.className = "optionAnswer";
        optionContainer.appendChild(option);
        //adding animation delay to each of item option
        option.style.animationDelay = animationDelay + 's';
        animationDelay = animationDelay + 0.15;

        option.setAttribute("onclick", "getResult(this)");

    }
     
}

function getResult(optionElement){
    // console.log(optionElement.innerHTML);
    const id = parseInt(optionElement.id);
    console.log(typeof id);
    if(id == currentQuestion.answer)
    {
        optionElement.classList.add("correct");
        //adding Indicator to correct answer
        updateAnswerIndicator("correct");
        correctAnswers++;
        console.log("correct: " + correctAnswers);
    }
    else
    {
        optionElement.classList.add("wrong");

        //adding Indicator to wrong answer
        updateAnswerIndicator("wrong");

        //if answer not correct, show the correct one 
        const optionLength = optionContainer.children.length;   
        for (let index = 0; index < optionLength; index++) {
            if (parseInt(optionContainer.children[index].id) === currentQuestion.answer) 
            {
                optionContainer.children[index].classList.add("correct");
            }
            
        }
    }

    unclickableOptions();
    attempt++;
}

//once user select user, make all options unclickable
function unclickableOptions(){
    const optionLength = optionContainer.children.length;
    for(let i=0; i<optionLength; i++)
    {
        optionContainer.children[i].classList.add("already-answered");
    }
}

function answersIndicator(){
    answersIndicatorContainer.innerHTML = '';
    const totalQuestion  = quiz.length;
    for (let index = 0; index < totalQuestion; index++) {
        const indicator = document.createElement("div");        

        answersIndicatorContainer.appendChild(indicator);

    }
}
function updateAnswerIndicator(markType){
    // console.log(markType);
    answersIndicatorContainer.children[questionCounter-1].classList.add(markType);
}

function next(){
    
    if(!optionContainer.children[1].classList.contains("already-answered"))
    {
        notAnswerNoti.classList.remove("hide");
        timerForNoti = setTimeout(() => {
            notAnswerNoti.classList.add('hide');
        }, 1000);
    }
    else 
    {
        if (questionCounter === quiz.length) {
            console.log("quiz over");
            quizOver();
        }
        else
        {
            getNewQuestion();
        }
    }   
    
   
}

function quizOver(){
    //hide quiz box
    quizBox.classList.add("hide");
    //show quiz box 
    resultBox.classList.remove("hide");
    quizResult();
}

function quizResult(){
    resultBox.querySelector(".total-question").innerHTML = quiz.length;
    resultBox.querySelector(".total-attempt").innerHTML = attempt;
    resultBox.querySelector(".total-correct").innerHTML = correctAnswers;
    resultBox.querySelector(".total-wrong").innerHTML = attempt - correctAnswers
    const percentage = correctAnswers / quiz.length * 100;
    resultBox.querySelector(".percentage").innerHTML = percentage.toFixed(2) + "%"; //toFixed convert int to string round up to specific decimal place
    resultBox.querySelector(".total-score").innerHTML = correctAnswers + " / " + quiz.length;
}

function resetQuiz()
{
    questionCounter = 0;
    correctAnswers = 0;
    attempt = 0;
}

function tryAgainQuiz(){
    resultBox.classList.add("hide");
    quizBox.classList.remove('hide');
    resetQuiz();
    startQuiz();
}

function goToHome(){
    resultBox.classList.add("hide");
    homeBox.classList.remove("hide");
    resetQuiz();
}

//  ============ Start Quiz ===========


function startQuiz(){

    homeBox.classList.add("hide");
    quizBox.classList.remove("hide");
    
    //set question in array
    setAvaliableQuestions();
    //get new questions
    getNewQuestion();
    
    answersIndicator();
}
 
window.onload = function(){
    homeBox.querySelector(".total-question").innerHTML = quiz.length;
}