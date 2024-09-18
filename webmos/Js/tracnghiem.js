// script.js
document.addEventListener('DOMContentLoaded', function() {
    fetch('get_questions.php')
        .then(response => response.json())
        .then(data => {
            const questionsContainer = document.getElementById('questions');
            data.forEach(question => {
                const questionDiv = document.createElement('div');
                questionDiv.classList.add('question');
                questionDiv.innerHTML = `
                    <p>${question.cauhoi}</p>
                    <input type="radio" name="question${question.idcauhoi}" value="a" id="a${question.idcauhoi}">
                    <label for="a${question.idcauhoi}">${question.a}</label><br>
                    <input type="radio" name="question${question.idcauhoi}" value="b" id="b${question.idcauhoi}">
                    <label for="b${question.idcauhoi}">${question.b}</label><br>
                    <input type="radio" name="question${question.idcauhoi}" value="c" id="c${question.idcauhoi}">
                    <label for="c${question.idcauhoi}">${question.c}</label><br>
                    <input type="radio" name="question${question.idcauhoi}" value="d" id="d${question.idcauhoi}">
                    <label for="d${question.idcauhoi}">${question.d}</label>
                `;
                questionsContainer.appendChild(questionDiv);
            });
        });
});
