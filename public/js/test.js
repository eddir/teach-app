
let steps = [];
let questions = [];
let step = 0;
let next = true;
$(function () {
    $.ajax({
        url: "/ajax/tests.php?test_id=" + location.search.split('test_id=')[1],
        timeout: 25e3,
        success: function (data) {
            questions = jQuery.parseJSON(data);
            fillQuestion(questions[step]);
            $('#title').html("Вопрос " + (step + 1) + "/" + questions.length);
        }
    });
    $("#answer").click(function(){
        if (next) {
            let i = 0;
            $('#description').hide();
            $('#answers').children('.field').each(function () {
                if ($(this).find('input').first().is(":checked") != questions[step]['answers'][i]['correct']) {
                    $('#description').html("Неправильно: "+questions[step]['description']).show();
                    $('html, body').animate({
                        scrollTop: $("#description").offset().top
                    }, 1000);
                    next = false;
                    return;
                }
                i++;
            });
            steps.push({'id': step++, 'status': next});
            if (next) {
                if (step < questions.length) {
                    fillQuestion(questions[step]);
                } else {
                    finish();
                }
            }
        } else {
            if (step < questions.length) {
                fillQuestion(questions[step]);
                next = true;
            } else {
                finish();
            }
        }
    });
});
function finish() {
    $('#description').hide();
    $('#question').hide();
    $('#answers').hide();
    $('#result').show();
    $("#answer").hide();
    $('#control').show();
    let right = 0;
    let wrong = 0;
    let all = steps.length;
    let i, stat;
    for (i = 0; i < all; i++) {
        if (steps[i]['status']) {
            right++;
        } else {
            wrong++;
        }
    }
    let mark = right/all*100;
    if (mark >= 90) {
        $('#title').html("Оценка: 5");
    } else if (mark >= 75) {
        $('#title').html("Оценка: 4");
    } else if (mark >= 45) {
        $('#title').html("Оценка: 3");
    } else {
        $('#title').html("Оценка: 2");
    }
    $('#result').html(right/all*100 + '% верно');
}
function fillQuestion(question) {
    $('#description').hide();
    $('#title').html("Вопрос "+(step+1)+"/"+questions.length);
    $('#question').html('<a target="_blank" href="/' + question['image'] + '"><img class="test_image" src="/' + question['image'] + '" alt="Вопрос"></a>');
    $('#answers').html("");
    let i = 0;
    for (var answer in question['answers']) {
        $('#answers').append(
            '<div class="field"><div class="inputGroup"><input id="option' + i
            + '" name="option' + i
            + '" type="checkbox"/><label for="option' + i
            + '">' + question['answers'][answer]['body']
            + '</label></div>'
        );
        i++;
    }

}