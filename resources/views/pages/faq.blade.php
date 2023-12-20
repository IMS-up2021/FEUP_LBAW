@extends('layouts.app')

@section('content')

<style>
    .answer {
        display: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var questions = document.querySelectorAll('.question');

        questions.forEach(function (question) {
            question.addEventListener('click', function () {
                var answer = this.querySelector('.answer');
                if (answer.style.display === 'block') {
                    answer.style.display = 'none';
                } else {
                    answer.style.display = 'block';
                }
            });
        });
    });
</script>

<h1 id = "faq-h1">Frequently Asked Questions</h1>
    
<div class="question">
    <h2>What is BrainShare?</h2>
    <p class="answer">BrainShare is an information system with a web interface designed to manage a community of users engaging in collaborative questions and answers.</p>
</div>

<div class="question">
    <h2>Who can participate?</h2>
    <p class="answer">Any registered user can participate by submitting questions, answers, or comments.</p>
</div>

<div class="question">
    <h2>How does the voting system work?</h2>
    <p class="answer">The community can vote on questions. The voting system helps highlight valuable contributions.</p>
</div>

<div class="question">
    <h2>Can I leave comments on questions or answers?</h2>
    <p class="answer">Yes, it is possible to associate brief comments with both questions and answers to provide additional context or clarification.</p>
</div>

@endsection
