import { Controller } from 'stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="userquizz" attribute will cause
 * this controller to be executed. The name "userquizz" comes from the filename:
 * userquizz_controller.js -> "userquizz"
 *
 * Delete this file or adapt it for your use!
 */

export default class extends Controller {
    static targets = [ "form", "current", "question" ]

    static values = {
        userquizz: Number
    }

    initialize() {
        this.index = this.currentTarget.value - 1
    }

    connect() {
        this.showCurrentQuestion()
    }

    previous() {
        if (this.index > 0) {
            this.index--
            this.showCurrentQuestion()
            this.updateUserQuizz()
        }
    }

    next() {
        if (this.index < this.questionTargets.length - 1) {
            this.index++
            this.showCurrentQuestion()
            this.updateUserQuizz()
        }
    }

    showCurrentQuestion() {
        this.hideQuestions()
        this.showQuestion(this.index)
    }

    hideQuestions() {
        this.questionTargets.forEach((element, i) => {
            element.classList.add('hidden')
        });
    }

    showQuestion(index) {
        this.questionTargets[index].classList.remove('hidden')
        this.currentTarget.value = index + 1
    }

    updateUserQuizz() {
        fetch(`/quizz/user-quizz/${this.userquizzValue}/update`, {
            method: 'POST',
            body: new FormData(this.formTarget),
        })
    }
}
