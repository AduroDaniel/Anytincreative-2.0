// Question Array
const questions = [
    { question: 'Enter Your First Name' },
    { question: 'Enter Your Last Name' },
    { question: 'Enter Your Email', pattern: /\S+@\S+\.\S+/ },
    { question: 'Enter Your Phone' }
];

//Transition Times
const shakeTime = 100; //Shake Transition Time
const switchTime = 200; // Transition Between Questions

// Init Position at First Question
let position = 0;

// Init DOM Elements
const formBox = document.querySelector('#form-box');
const nextBtn = document.querySelector('#next-btn');
const prevBtn = document.querySelector('#prev-btn');
const inputGroup = document.querySelector('#input-group');
const inputField = document.querySelector('#input-field');
const inputLabel = document.querySelector('#input-label');
const inputProgress = document.querySelector('#input-progress');
const progress = document.querySelector('#progress-bar');

//EVENTS

// Get Question on DOM Load
document.addEventListener('DOMContentLoaded', getQuestion);

// Next Button Click
nextBtn.addEventListener('click', validate);

// Input Field enter click
inputField.addEventListener('keyup', e => {
    if (e.keyCode == 13) {
        validate();
    }
})


// FUNCTIONS

// Get Question From Array & Add to Markup
function getQuestion() {
    // Get Current Question
    inputLabel.innerHTML = questions[position].question;
    // Get Current Type
    inputField.type = questions[position].type || 'text';
    // Get Current Answer
    inputField.value = questions[position].answer || '';
    // Focus on Element
    inputField.focus();

    // Set Progress Bar Width - Variable to the question length
    progress.style.width = (position * 100) / questions.length + '%';

    // Add user icon OR previous button depending on question
    prevBtn.className = position ? 'fa fa-arrow-left' : 'fa fa-user-circle';

    showQuestion();
}

// Display question to User
function showQuestion() {
    inputGroup.style.opacity = 1;
    inputProgress.style.transition = '';
    inputProgress.style.width = '100%';
}

// Hide Question
function hideQuestion() {
    inputGroup.style.opacity = 0;
    inputLabel.style.marginLeft = 0;
    inputProgress.style.width = 0;
    inputProgress.style.transition = 'none';
    inputProgress.style.border = null;
}

// Transform to Create Shake Motion
function transform(x, y) {
    formBox.style.transform = `translate(${x}px, ${y}px)`;
}

// Validate Field
function validate() {
    // Make sure pattern Matches if there is one
    if (!inputField.value.match(questions[position].pattern || /.+/)) {
        inputFail();
    } else {
        inputPass();
    }
}

// Field Input Fail
function inputFail() {
    formBox.className = 'error';
    // Repeat Shake Motion - set i to number of shakes
    for (let i = 0; i < 6; i++) {
        setTimeout(transform, shakeTime * i, ((i % 2) * 2 - 1) * 20, 0);
        setTimeout(transform, shakeTime * 6, 0, 0);
        inputField.focus();
    }
}

// Field Input Passed
function inputPass() {
    formBox.className = '';
    setTimeout(transform, shakeTime * 0, 0, 10);
    setTimeout(transform, shakeTime * 1, 0, 0);

    // Store Answer in Array
    questions[position].answer = inputField.value;

    // Increment Position
    position++;

    // If new Question, hide current and Get next
    if (questions[position]) {
        hideQuestion();
        getQuestion();
    } else {
        // Remove if no more question
        hideQuestion();
        formBox.className = 'close';
        progress.style.width = '100%';

        // Form complete
        formComplete();
    }
}

// All fields complete - show h1 end
function formComplete() {
    const h1 = document.createElement('h1');
    h1.classList.add('end');
    h1.appendChild(document.createTextNode(`Thanks ${questions[0].answer} You are registered and will get an email shortly`));
    setTimeout(() => {
        formBox.parentElement.appendChild(h1);
        setTimeout(() => (h1.style.opacity = 1), 50);
    }, 1000);
}