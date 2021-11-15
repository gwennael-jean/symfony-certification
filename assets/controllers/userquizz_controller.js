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

    initialize() {
        this.index = 0
    }

    connect() {
        this.showCurrentQuestion()
    }

    next() {
        this.index++
        this.showCurrentQuestion()
    }

    previous() {
        this.index--
        this.showCurrentQuestion()
    }

    showCurrentQuestion() {
        this.questionTargets.forEach((element, index) => {
            index === this.index
                ? element.classList.remove('hidden')
                : element.classList.add('hidden')
        })
    }
}
