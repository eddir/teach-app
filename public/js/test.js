let steps = [];
let questions = [];
let step = 0;
let next = true;

function start() {
    $.ajax({
        url: "/ajax/tests.php?test_id=" + location.search.split('test_id=')[1],
        timeout: 25e3,
        success: function (data) {
            questions = jQuery.parseJSON(data);
            fillQuestion(questions[step]);
            $('#title').html("Вопрос " + (step + 1) + "/" + questions.length);
        }
    });
}


$(function () {
    $("#answer").click(function () {
        if (next) {
            let i = 0;
            $('#description').hide();
            $('#answers').children('.field').each(function () {
                console.log(questions[step]['answers']);
                if ($(this).find('input').first().is(":checked") != questions[step]['answers'][i]['correct']) {
                    let rights = [];
                    for (var u = 0; u < questions[step]['answers'].length; u++) {
                        if (questions[step]['answers'][u]['correct'] == 1) {
                            rights.push(questions[step]['answers'][u]['body']);
                        }
                    }
                    console.log(rights);
                    $('#description').html("Неправильно: " + rights.join(', ').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;') + '.' + questions[step]['description']).show();
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
    let mark = right / all * 100;
    if (mark >= 90) {
        $('#title').html("Отличный результат");
    } else if (mark >= 75) {
        $('#title').html("Хороший результат");
    } else if (mark >= 45) {
        $('#title').html("Удовлетворительный результат");
    } else {
        $('#title').html("Плохой результат");
    }
    $('#result').html(Math.round(right / all * 100) + '% верно');
    $.ajax({
        url: '/ajax/sendStat.php',
        method: 'POST',
        data: {
            test_id: location.search.split('test_id=')[1],
            right_answers: right,
            wrong_answers: wrong
        }
    });
}

function fillQuestion(question) {
    $('#description').hide();
    $('#title').html("Вопрос " + (step + 1) + "/" + questions.length);
    $('#question').html("");
    if (question['image']) {
        $('#question').html('<a target="_blank" href="/' + question['image'] + '"><img class="test_image" src="/' + question['image'] + '" alt="Вопрос"></a>');
    }
    $('#question').append('<p>' + question['body'] + '</p>');
    $('#answers').html("");
    let i = 0;
    for (var answer in question['answers']) {
        $('#answers').append(
            '<div class="field"><div class="inputGroup"><input id="option' + i
            + '" name="option' + i
            + '" type="checkbox"/><label for="option' + i
            + '"><pre>' + question['answers'][answer]['body'].replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            + '</pre></label></div>'
        );
        i++;
    }

}

function deleteTest(test_id) {
    $('#remove').modal();
    $('#remove').attr('data-test-id', test_id);
}

function forceDeleteTest() {
    $('#remove').modal('toggle');
    let test_id = $('#remove').attr('data-test-id');
    $.ajax({
        url: '/ajax/removeTest.php',
        method: 'POST',
        data: {
            'test_id': test_id
        },
        success: function (data) {
            $('#content').html(data);
        }
    });
}

function deletePost(post_id) {
    $('#remove').modal();
    $('#remove').attr('data-post-id', post_id);
}

function forceDeletePost() {
    $('#remove').modal('toggle');
    let post_id = $('#remove').attr('data-post-id');
    $.ajax({
        url: '/ajax/removePost.php',
        method: 'POST',
        data: {
            'post_id': post_id
        },
        success: function (data) {
            $('#content').html(data);
        }
    });
}