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
    static targets = [ "question" ]

    static values = {
        userquizz: Number
    }

    initialize() {
        this.index = 0
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
        this.questionTargets.forEach((element, index) => {
            index === this.index
                ? element.classList.remove('hidden')
                : element.classList.add('hidden')
        })
    }

    updateUserQuizz() {
        let r = new XMLHttpRequest();

        r.open("POST", `/quizz/user-quizz/${this.userquizzValue}/update`, true);
        r.onreadystatechange = function () {
            if (r.readyState !== 4 || r.status !== 200)
                return;

            console.log(r.responseText);
        };

        r.send("banana=yellow");
    }
}
